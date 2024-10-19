<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'card_token',
        'last_four',
        'brand',
        'exp_month',
        'exp_year',
        'holder_name',
        'is_default',
        'is_active',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


}
