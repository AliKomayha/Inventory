<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'price_type',
        'quantity',
        'unit_price',
        'date',
    ];
    public function product(){

        return $this->belongsTo(Product::class);
    }
}
