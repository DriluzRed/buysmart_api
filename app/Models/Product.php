<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'sub_category_id',
        'brand_id',
        'main_image',
        'is_on_sale',
        'sale_price',
        'slug',
        'is_featured',
        'is_new',
        'is_bestseller',
        'sale_start',
        'sale_end',
        'banner_image',
        'on_slider',
    ];

    public function setMainImageAttribute($value)
    {
        $attribute_name = "main_image";  // Usar el nombre correcto de la columna
        $disk = "public"; // Define el disco donde quieres almacenar la imagen
        $destination_path = "uploads/products"; // Subcarpeta en storage/app/public

        // Si la imagen fue borrada
        if ($value == null) {
            Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // Si se sube un archivo nuevo
        if (is_file($value)) {
            // Almacena la imagen y obtén la ruta
            $path = $value->store($destination_path, $disk);

            // Elimina la imagen anterior si ya existe
            Storage::disk($disk)->delete($this->{$attribute_name});

            // Guarda la nueva ruta en la base de datos
            $this->attributes[$attribute_name] = $path;
        }
    }
    public function setBannerImageAttribute($value)
    {
        $attribute_name = "banner_image";  // Nombre de la columna correcta
        $disk = "public"; // Disco donde quieres almacenar la imagen
        $destination_path = "uploads/products/banners"; // Subcarpeta en storage/app/public

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



    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }
    
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
    
}
