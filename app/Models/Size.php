<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
}
