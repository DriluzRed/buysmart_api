<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Order extends Model
{
    use CrudTrait;
    use HasFactory;
    
    protected $fillable = [
        'customer_id',
        'status',
        'payment_method_id',
        'payment_status',
        'address_id',
        'subtotal',
        'additional_charges',
        'total',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
    
    public function getStatusTranslatedAttribute()
    {
        $statuses = [
            'pending' => 'Pendiente',
            'confirmed' => 'Confirmado',
            'delivered' => 'Entregado',
            'shipped' => 'Enviado',
            'completed' => 'Completado',
            'refunded' => 'Reembolsado',
            'failed' => 'Fallido',
            'declined' => 'Rechazado',
            'holded' => 'Retenido',
            'cancelled' => 'Cancelado',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function getFormattedTotalAttribute()
    {
        return 'Gs ' . Helper::formatPrice($this->total);
    }

    public function getCustomerPhoneAttribute()
    {
        return $this->customer->phone;
    }


}
