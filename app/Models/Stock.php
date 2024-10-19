<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'min_quantity',
        'max_quantity',
        'alert_quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    
}
