<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_details';
    protected $fillable = [
        'transaction_id',
        'product_id',
        'price',
        'quantity',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    static function tambahDetailTransaksi($transaction_id, $product_id, $price, $quantity)
    {
        TransactionDetail::create([
            'transaction_id' => $transaction_id,
            'product_id' => $product_id,
            'price' => $price,
            'quantity' => $quantity,
        ]);
    }
}
