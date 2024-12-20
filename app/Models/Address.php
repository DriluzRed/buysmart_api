<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'neighborhood_id',
        'city_id',
        'department_id',
        'address_line_1',
        'address_line_2',
        'type',
        'is_main',
        'for_billing',
        'latitude',
        'longitude',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getFullAddressAttribute()
    {
        return "{$this->address_line_1} - {$this->address_line_2}, {$this->city->name}, {$this->department->name}";
    }

    
}
