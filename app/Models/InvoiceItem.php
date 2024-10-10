<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'order_item_id',
        'quantity',
        'unit_price',
        'total',
        'description',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function orderItem()
    {
        return $this->hasOne(OrderItem::class);
    }
    
}
