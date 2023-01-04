<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Categorie;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search =  $request->search;

        $products = Product::where('name', 'like', '%' . $search . '%')
            ->paginate(4);
        return view('app.products.index', ['products' => $products]);
    }
    public function create()
    {
        $categories = Categorie::all()->sortBy('name');
        $brands = Brand::all()->sortBy('name');
        return view('app.products.create', ['categories' => $categories, 'brands' => $brands]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);

        Product::create([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Barang berhasil ditambahkan');
        return redirect('/products');
    }
    public function edit($id)
    {
        $categories = Categorie::all()->sortBy('name');
        $brands = Brand::all()->sortBy('name');
        $product = Product::find($id);
        return view('app.products.edit', ['product' => $product, 'categories' => $categories, 'brands' => $brands]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);

        Product::where('id', $id)
            ->update([
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
            ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Barang berhasil diubah');
        return redirect('/products');
    }
    public function delete($id)
    {
        if (Product::find($id)->transaksi()->exists()) {
            Session::flash('status', 'error');
            Session::flash('message', 'Barang tidak bisa dihapus');
            return redirect('/products');
        }

        Product::destroy($id);
        Session::flash('status', 'success');
        Session::flash('message', 'Barang berhasil dihapus');
        return redirect('/products');
    }
}
