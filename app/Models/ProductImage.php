<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory, CrudTrait;

    protected $fillable = [
        'product_id',
        'image',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = "public";
        $destination_path = "uploads/products/images";

        // Si el valor es nulo, elimina la imagen existente
        if ($value == null) {
            Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // Si el valor es un archivo, súbelo al disco
        if (is_file($value)) {
            $path = $value->store($destination_path, $disk);

            // Elimina la imagen anterior si existe
            if ($this->{$attribute_name}) {
                Storage::disk($disk)->delete($this->{$attribute_name});
            }

            $this->attributes[$attribute_name] = $path;
        }

        // Si el valor es una cadena (ruta de archivo), simplemente asigna la ruta
        if (is_string($value)) {
            $this->attributes[$attribute_name] = $value;
        }
    }
}