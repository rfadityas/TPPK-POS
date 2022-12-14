<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $alltransactions = Transaction::all();
        $alltransactionstoday = Transaction::whereDate('created_at', Carbon::today())->orderby('created_at', 'desc')->get();
        $revenuethismonth = Transaction::where('created_at', Carbon::now()->month)->sum('total_price');
        $revenuelastmonth = Transaction::where(
            'created_at',
            '>=',
            Carbon::now()->subMonth()->toDateTimeString()
        )->sum('total_price');;
        $revenuethisyear = Transaction::where('created_at', Carbon::now()->year)->sum('total_price');
        return view('transactions', [
            'alltransactions' => $alltransactions,
            'alltransactionstoday' => $alltransactionstoday,
            'revenuelastmonth' => $revenuelastmonth,
            'revenuethismonth' => $revenuethismonth,
            'revenuethisyear' => $revenuethisyear
        ]);
    }
}
