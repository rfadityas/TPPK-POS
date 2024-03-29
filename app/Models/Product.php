<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'price',
        'stock'
    ];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function transaksi()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
