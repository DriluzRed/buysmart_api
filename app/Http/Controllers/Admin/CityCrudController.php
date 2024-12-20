<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CityRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CityCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CityCrudController extends CrudController
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
        CRUD::setModel(\App\Models\City::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/city');
        CRUD::setEntityNameStrings('ciudad', 'ciudades');
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
            'name' => 'name',
            'type' => 'text',
            'label' => 'Nombre',
        ]);
        CRUD::addColumn([
            'name' => 'department_id',
            'type' => 'select',
            'label' => 'Departamento',
            'attribute' => 'name',
            'entity' => 'department',
            'model' => \App\Models\Department::class,
        ]);

        CRUD::addColumn([
            'name' => 'population',
            'type' => 'text',
            'label' => 'Poblacion',
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
        CRUD::setValidation(CityRequest::class);
        CRUD::addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Nombre',
        ]);
        CRUD::addField([
            'name' => 'department_id',
            'type' => 'select',
            'label' => 'Departamento',
            'entity' => 'department',
            'attribute' => 'name',
            'model' => \App\Models\Department::class,
        ]);

        CRUD::addField([
            'name' => 'population',
            'type' => 'number',
            'label' => 'Poblacion',
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
