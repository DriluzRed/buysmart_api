<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'logo',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    

    public function setLogoAttribute($value)
    {
        $attribute_name = "logo";
        $disk = "public";
        $destination_path = "uploads/brands";

        if ($value == null) {
            if ($this->{$attribute_name}) { // Verificar si hay una imagen guardada previamente
                Storage::disk($disk)->delete($this->{$attribute_name});
            }
            $this->attributes[$attribute_name] = null;
        }

        // Si se sube un archivo nuevo
        if (is_file($value)) {
            // Almacena la imagen y obtén la ruta
            $path = $value->store($destination_path, $disk);

            // Elimina la imagen anterior si ya existe
            if ($this->{$attribute_name}) {
                Storage::disk($disk)->delete($this->{$attribute_name});
            }

            // Guarda la nueva ruta en la base de datos
            $this->attributes[$attribute_name] = $path;
        }
    }
}
