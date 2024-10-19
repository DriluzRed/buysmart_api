<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'ci',
        'birthdate',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function creditCards()
    {
        return $this->hasMany(CreditCard::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
}
