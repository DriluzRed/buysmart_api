<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StockRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StockCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class StockCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Stock::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/stock');
        CRUD::setEntityNameStrings('Stock de producto', 'Stocks de productos');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'product_id',
            'label' => 'Producto',
            'type' => 'relationship',
            'attribute' => 'name',
        ]);

        CRUD::addColumn([
            'name' => 'quantity',
            'label' => 'Cantidad',
            'type' => 'number',
        ]);

        CRUD::addColumn([
            'name' => 'min_quantity',
            'label' => 'Cantidad mínima',
            'type' => 'number',
        ]);

        CRUD::addColumn([
            'name' => 'max_quantity',
            'label' => 'Cantidad máxima',
            'type' => 'number',
        ]);

        CRUD::addColumn([
            'name' => 'alert_quantity',
            'label' => 'Cantidad de alerta',
            'type' => 'number',
        ]);

        CRUD::addColumn([
            'name' => 'created_at',
            'label' => 'Creado en',
            'type' => 'datetime',
        ]);

        CRUD::addColumn([
            'name' => 'updated_at',
            'label' => 'Actualizado en',
            'type' => 'datetime',
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
        CRUD::setValidation(StockRequest::class);
        
        CRUD::addField([
            'name' => 'product_id',
            'label' => 'Producto',
            'type' => 'select',
            'entity' => 'product',
            'attribute' => 'name',
            'model' => \App\Models\Product::class,
        ]);

        CRUD::addField([
            'name' => 'quantity',
            'label' => 'Cantidad',
            'type' => 'number',
        ]);

        CRUD::addField([
            'name' => 'min_quantity',
            'label' => 'Cantidad mínima',
            'type' => 'number',
        ]);

        CRUD::addField([
            'name' => 'max_quantity',
            'label' => 'Cantidad máxima',
            'type' => 'number',
        ]);

        CRUD::addField([
            'name' => 'alert_quantity',
            'label' => 'Cantidad de alerta',
            'type' => 'number',
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
