<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
        'population',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}