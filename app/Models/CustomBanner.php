<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CustomBanner extends Model
{
    use CrudTrait;
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'custom_banners';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function getAllBanners() : \Illuminate\Support\Collection
    {
        $banners = self::where('image', '!=', null)
        ->get()
        ->map(function ($banner) {
            return (object) [
                'id' => $banner->id,
                'image' => $banner->image,
                'link' => $banner->link,
            ];
        });

        return $banners->isEmpty() ? collect() : $banners;
    }
    public function setImageAttribute($value)
    {
        $attribute_name = "image";  // Nombre de la columna correcta
        $disk = "public"; // Disco donde quieres almacenar la imagen
        $destination_path = "uploads/products/custom_banners"; // Subcarpeta en storage/app/public

        // Si la imagen fue borrada
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
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
