<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use CrudTrait;
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
