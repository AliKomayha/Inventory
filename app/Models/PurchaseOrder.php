<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_type', 
        'shipment_cost',
        'date'
    ];

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
