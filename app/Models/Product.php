<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'delegate_price',
        'wholesale_price',
        'sales_price',
    ];

    public function purchaseItems(){
        return $this->hasMany(PurchaseItem::class);
    }

    public function sales(){
        return $this->hasMany(Sale::class);
    }
}
