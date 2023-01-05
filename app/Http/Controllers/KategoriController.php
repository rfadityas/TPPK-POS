<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $search =  $request->search;

        $categories = Categorie::where('name', 'like', '%' . $search . '%')
            ->paginate(6);
        return view('app.kategori.index', ['categories' => $categories]);
    }
    public function create()
    {
        return view('app.kategori.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Categorie::create([
            'name' => $request->name,
        ]);

        Session::flash('status', 'success');
        Session::flash('message', 'Kategori berhasil ditambahkan');
        return redirect('/kategori');
    }
    public function delete($id)
    {
        $categorie = Categorie::find($id);
        $categorie->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Kategori berhasil dihapus');
        return redirect('/kategori');
    }
    public function edit($id)
    {
        $categorie = Categorie::find($id);
        return view('app.kategori.edit', ['categorie' => $categorie]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $categorie = Categorie::find($id);
        $categorie->name = $request->name;
        $categorie->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Kategori berhasil diubah');
        return redirect('/kategori');
    }
}
