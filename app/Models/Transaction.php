<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price'
    ];
    static function tambahTransaksi()
    {
        $data = Transaction::create([
            'user_id' => auth()->user()->id,
            'total_price' => \Cart::getTotal(),
        ]);

        return $data->id;
    }
}
