<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'total',
        'description',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function invoiceItem()
    {
        return $this->hasOne(InvoiceItem::class);
    }

    public function getProductNameAttribute()
    {
        return $this->product->name;
    }

    public function getFormattedItemsAttribute()
    {
        return $this->items->map(function ($item) {
            return [
                'product_name' => $item->product_name,
                'quantity' => $item->quantity,
                'price' => number_format($item->price, 2),
            ];
        })->toArray();
    }
    
}
