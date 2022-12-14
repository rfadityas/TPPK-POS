<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $totaltrx = Transaction::all()->count();
        $totalprod = Product::all()->count();
        $totalcat = Categorie::all()->count();
        return view('dashboard', ['totaltrx' => $totaltrx, 'totalprod' => $totalprod, 'totalcat' => $totalcat]);
    }
}
