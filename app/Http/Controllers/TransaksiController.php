<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    public function index()
    {
        $alltransactions = Transaction::all();
        $alltransactionstoday = Transaction::whereDate('created_at', Carbon::today())->orderby('created_at', 'desc')->simplePaginate(5);
        $revenuethismonth = Transaction::whereMonth('created_at', Carbon::now()->month)->sum('total_price');
        $revenuelastmonth = Transaction::where(
            'created_at',
            '>=',
            Carbon::now()->subMonth()->toDateTimeString()
        )->sum('total_price');;
        $revenuethisyear = Transaction::whereYear('created_at', Carbon::now()->year)->sum('total_price');
        return view('app.transactions.list', [
            'alltransactions' => $alltransactions,
            'alltransactionstoday' => $alltransactionstoday,
            'revenuelastmonth' => $revenuelastmonth,
            'revenuethismonth' => $revenuethismonth,
            'revenuethisyear' => $revenuethisyear
        ]);
    }
    public function create(Request $request)
    {
        $search =  $request->search;

        $products = Product::where('name', 'like', '%' . $search . '%')
            ->paginate(4);
        return view('app.transactions.create', ['products' => $products]);
    }
    public function store(Request $request)
    {
        $detailbarang = Product::where('id', $request->idbarang)->first();

        if ($detailbarang->stock == 0) {
            return redirect()->back()->with('error', 'Stock tidak mencukupi');
        }
        if (\Cart::get($request->idbarang)) {
            if (\Cart::get($request->idbarang)->quantity == $detailbarang->stock) {
                return redirect()->back()->with('error', 'Stock tidak mencukupi');
            }
        }

        \Cart::add([
            'id' => $request->idbarang,
            'name' => $detailbarang->name,
            'price' => $detailbarang->price,
            'quantity' => 1,
            'attributes' => array(
                'brand' => $detailbarang->brand->name,
            )
        ]);
    }
    public function destroy($id)
    {
        \Cart::remove($id);
        return view('app.transactions.cart');
    }
    public function addqty($id)
    {
        $stock = Product::where('id', $id)->first()->stock;

        if (\Cart::get($id)->quantity == $stock) {
            return redirect()->back()->with('error', 'Stock tidak mencukupi');
        }

        \Cart::update($id, array(
            'quantity' => 1,
        ));
        return view('app.transactions.cart');
    }
    public function removeqty($id)
    {
        if (\Cart::get($id)->quantity == 1) {
            \Cart::remove($id);
        } else {
            \Cart::update($id, array(
                'quantity' => -1,
            ));
        }
        return view('app.transactions.cart');
    }
    public function getcart()
    {
        return view('app.transactions.cart');
    }
    public function savetransaksi(Request $request)
    {
        $transaction_id = Transaction::tambahTransaksi($request->bayar);

        foreach (\Cart::getContent() as $item) {
            $id_barang = $item->id;
            $jumlah = $item->quantity;
            $harga = $item->price * $item->quantity;
            TransactionDetail::tambahDetailTransaksi($transaction_id, $id_barang, $harga, $jumlah);
        }

        $transaction1 = Transaction::where('id', $transaction_id)->first();
        $transactiondetails = TransactionDetail::where('transaction_id', $transaction_id)->get();
        $pdf = PDF::loadView('app.transactions.nota', [
            'transaction1' => $transaction1,
            'transactiondetails' => $transactiondetails
        ]);
        $pdf->setPaper('A4', 'landscape');
        Storage::put('public/pdf/' . $transaction1->invoice, $pdf->output());

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil menambah transaksi dengan id #' . $transaction_id);
        \Cart::clear();
        // return redirect()->intended('/transaksi/tambah');
    }
    public function detail($id)
    {
        $transaction1 = Transaction::where('id', $id)->first();
        $transactiondetails = TransactionDetail::where('transaction_id', $id)->get();
        return view('app.transactions.detail', [
            'transaction1' => $transaction1,
            'transactiondetails' => $transactiondetails
        ]);
    }
    public function semuatransaksi(Request $request)
    {
        $search =  $request->search;
        $alltransactions = Transaction::where('id', 'like', '%' . $search . '%')
            ->paginate(4);
        return view('app.transactions.alllist', ['alltransactions' => $alltransactions]);
    }
    public function sendinvoice($id)
    {
        // $transaction1 = Transaction::where('id', $id)->first();
        // $transactiondetails = TransactionDetail::where('transaction_id', $id)->get();
        // $pdf = PDF::loadView('app.transactions.nota', [
        //     'transaction1' => $transaction1,
        //     'transactiondetails' => $transactiondetails
        // ]);
        // $pdf->setPaper('A4', 'landscape');
        // // Storage::put('public/pdf/test2.pdf', $pdf->output());
        // return $pdf->download('test2.pdf');
        // return $pdf->stream();
        // if (Storage::disk('local')->exists('public/pdf/test2.pdf')) {
        //     Storage::get('public/pdf/test2.pdf');
        // } else {
        //     dd('tidak ada');
        // }
    }
    public function cek($id)
    {
        $transaction1 = Transaction::where('id', $id)->first();
        $transactiondetails = TransactionDetail::where('transaction_id', $id)->get();
        return view('app.transactions.nota', [
            'transaction1' => $transaction1,
            'transactiondetails' => $transactiondetails
        ]);
    }
}
