<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CustomBannerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CustomBannerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustomBannerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\CustomBanner::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/custom-banner');
        CRUD::setEntityNameStrings('custom banner', 'custom banners');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'image',
            'label' => 'Image',
            'type' => 'image',
            'prefix' => 'storage/', // Prefijo para las rutas de las imágenes
            'height' => '50px',
            'width' => '50px',
        ]);
        $this->crud->addColumn([
            'name' => 'title',
            'label' => 'Titulo',
            'type' => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'link',
            'label' => 'Link',
            'type' => 'text',
        ]);


    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CustomBannerRequest::class);
        $this->crud->addField([
            'name' => 'image',
            'label' => 'Imagen del banner (tamaño 1920x500)',
            'type'  => 'upload',
            'upload' => true,
            'disk' => 'public', 
        ],);

        $this->crud->addField([
            'name' => 'title',
            'label' => 'Titulo',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'link',
            'label' => 'Link',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'description',
            'label' => 'Descripción',
            'type' => 'textarea',

        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
