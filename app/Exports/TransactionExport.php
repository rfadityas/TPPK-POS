<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class TransactionExport implements FromView
{
    use Exportable;

    protected $from_date;
    protected $to_date;

    public function __construct($from_date, $to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function view(): View
    {
        return view('app.transactions.export', [
            'transactions' => Transaction::whereBetween('created_at', [$this->from_date, $this->to_date])->get(),
            'total' => Transaction::whereBetween('created_at', [$this->from_date, $this->to_date])->sum('total_price'),
        ]);
    }
}
