<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;


/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('producto', 'productos');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
       CRUD::addColumns(
        [
            [
                'name' => 'main_image',  // Nombre de la columna de la base de datos
                'label' => 'Imagen',
                'type' => 'image',
                'prefix' => 'storage/', // Prefijo para las rutas de las imágenes
                'height' => '50px',
                'width' => '50px',
            ],
            [
                'name' => 'name',
                'type' => 'text',
                'label' => 'Nombre',
            ],
            [
                'name' => 'description',
                'type' => 'text',
                'label' => 'Descripción',
            ],
            [
                'name' => 'slug',
                'type' => 'text',
                'label' => 'Slug',
            ],
            [
                'name' => 'category_id',
                'type' => 'select',
                'label' => 'Categoria',
                'entity' => 'category',
                'attribute' => 'name',
                'model' => \App\Models\Category::class,
            ],
            [
                'name' => 'sub_category_id',
                'type' => 'select',
                'label' => 'Sub Categoria',
                'entity' => 'subCategory',
                'attribute' => 'name',
                'model' => \App\Models\SubCategory::class,
            ],
            [
                'name' => 'brand_id',
                'type' => 'select',
                'label' => 'Marca',
                'entity' => 'brand',
                'attribute' => 'name',
                'model' => \App\Models\Brand::class,
            ],
            [
                'name' => 'price',
                'type' => 'number',
                'label' => 'Precio',
            ],
            [
                'name' => 'is_on_sale',
                'type' => 'boolean',
                'label' => 'En oferta',

            ],
            [
                'name' => 'sale_price',
                'type' => 'number',
                'label' => 'Precio de oferta',

            ],
            [
                'name' => 'is_featured',
                'type' => 'boolean',
                'label' => 'Se muestra en la página principal',
                'default' => 1,
            ],
        ]
        );
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::addFields(
            [
                [
                    'name' => 'name',
                    'type' => 'text',
                    'label' => 'Nombre',
                ],
                [
                    'name' => 'description',
                    'type' => 'textarea',
                    'label' => 'Descripción',
                ],
                [
                    'name' => 'slug',
                    'type' => 'text',
                    'label' => 'Slug',
                ],
                [
                    'name'  => 'main_image',
                    'label' => 'Imagen principal (tamaño 800x800)',
                    'type'  => 'upload',
                    'upload' => true,
                    'disk' => 'public', 
                ],
                [
                    'name' => 'category_id',
                    'type' => 'select',
                    'label' => 'Categoria',
                    'entity' => 'category',
                    'attribute' => 'name',
                    'model' => \App\Models\Category::class,
                ],
                [
                    'name' => 'sub_category_id',
                    'type' => 'select',
                    'label' => 'Sub Categoria',
                    'entity' => 'subcategory',
                    'attribute' => 'name',
                    'model' => \App\Models\SubCategory::class,
                ],
                [
                    'name' => 'brand_id',
                    'type' => 'select',
                    'label' => 'Marca',
                    'entity' => 'brand',
                    'attribute' => 'name',
                    'model' => \App\Models\Brand::class,
                ],
                [
                    'name' => 'price',
                    'type' => 'number',
                    'label' => 'Precio',
                ],
                [
                    'name' => 'is_on_sale',
                    'type' => 'boolean',
                    'label' => 'En oferta',

                ],
                [
                    'name' => 'sale_price',
                    'type' => 'number',
                    'label' => 'Precio de oferta',

                ],
                [
                    'name' => 'is_featured',
                    'type' => 'boolean',
                    'label' => 'Se muestra en la página principal',
                ],
                [
                    'name' => 'is_new',
                    'type' => 'boolean',
                    'label' => 'Es nuevo',
                ],
                [
                    'name' => 'is_bestseller',
                    'type' => 'boolean',
                    'label' => 'Es el más vendido',
                ],
                [
                    'name' => 'on_slider',
                    'type' => 'boolean',
                    'label' => 'En el slider',
                ],
                [
                    'name' => 'banner_image',
                    'label' => 'Imagen del banner (tamaño 1920x500)',
                    'type'  => 'upload',
                    'upload' => true,
                    'disk' => 'public', 
                ],
                [
                    'name' => 'images', // El nombre del campo
                    'label' => 'Imágenes del producto', // Etiqueta del campo
                    'type' => 'upload_multiple', // Tipo de campo para múltiples archivos
                    'upload' => true, // Permitir subida de archivos
                    'disk' => 'public', // El disco donde se guardarán (asegúrate de que esté configurado en config/filesystems.php)
                ]
            ]
        );
        
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->crud->hasAccessOrFail('update');

        // Llama a setupCreateOperation para configurar todos los campos
        $this->setupCreateOperation();

        // Luego agrega o ajusta cualquier campo específico para la operación de actualización aquí
        $product = $this->crud->getCurrentEntry();

        // Modifica el campo de imágenes para mostrar las existentes
        $this->crud->addField([
            'name' => 'images',
            'label' => 'Imágenes del producto',
            'type' => 'upload_multiple',
            'upload' => true,
            'disk' => 'public',
            'value' => $product->productImages->pluck('image')->map(function($path) {
                return ($path);
            })->toArray(), // Asegúrate de que sea un array de URLs
        ]);
    }


    public function store(ProductRequest $request)
    {
        $response = $this->traitStore();
    
        if ($request->hasFile('images')) {
            $productId = $this->crud->entry->id;
    
            foreach ($request->file('images') as $file) {
                $path = $file->store('uploads/products/images', 'public'); // Cambia 'images' y 'public' según tu configuración
    
                ProductImage::create([
                    'product_id' => $productId,
                    'image' => $path,
                ]);
            }
        }
    
        return $response;
    }
    
    public function update(ProductRequest $request)
    {
        $response = $this->traitUpdate();
        if($request->has('clear_images')) {
            ProductImage::where('product_id', $this->crud->getCurrentEntryId())->delete();
        }
        if ($request->has('images')) {
            $productId = $this->crud->entry->id;
    
            foreach ($request->file('images') as $file) {
                $path = $file->store('uploads/products/images', 'public'); // Cambia 'images' y 'public' según tu configuración
    
                ProductImage::create([
                    'product_id' => $productId,
                    'image' => $path,
                ]);
            }
        }
        
        return $response;
    }
    

}
