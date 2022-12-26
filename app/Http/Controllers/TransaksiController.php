<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Session;

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
            ->paginate(6);
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
    public function savetransaksi()
    {
        $transaction_id = Transaction::tambahTransaksi();

        foreach (\Cart::getContent() as $item) {
            $id_barang = $item->id;
            $jumlah = $item->quantity;
            $harga = $item->price * $item->quantity;
            TransactionDetail::tambahDetailTransaksi($transaction_id, $id_barang, $harga, $jumlah);
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Berhasil menambah transaksi');
        \Cart::clear();
        // return redirect()->intended('/transaksi/tambah');
    }
    public function detail($id)
    {
        $transaction = Transaction::where('id', $id)->first();
        $transactiondetails = TransactionDetail::where('transaction_id', $id)->get();
        return view('app.transactions.detail', [
            'transaction' => $transaction,
            'transactiondetails' => $transactiondetails
        ]);
    }
}
