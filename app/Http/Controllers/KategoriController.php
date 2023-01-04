<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $search =  $request->search;

        $categories = Categorie::where('name', 'like', '%' . $search . '%')
            ->paginate(6);
        return view('app.kategori.index', ['categories' => $categories]);
    }
}
