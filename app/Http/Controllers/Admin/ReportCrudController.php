<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ReportRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ReportCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ReportCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Report::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/report');
        CRUD::setEntityNameStrings('reporte', 'reportes');
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
            'name' => 'name', // Nombre de la columna en la tabla
            'type' => 'text', // Tipo de columna
            'label' => 'Título', // Etiqueta para mostrar
        ]);
    
        $this->crud->addColumn([
            'name' => 'variables',
            'type' => 'text', // Backpack maneja columnas JSON con este tipo
            'label' => 'Variables',
        ]);
        
        $this->crud->addColumn([
            'name' => 'custom_query',
            'type' => 'text',
            'label' => 'Query',
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
        CRUD::setValidation(ReportRequest::class);
        
        $this->crud->addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Título',
        ]);

        $this->crud->addField([
            'name' => 'variables',
            'type' => 'text',
            'label' => 'Variables',
        ]);

        $this->crud->addField([
            'name' => 'custom_query',
            'type' => 'textarea',
            'label' => 'Query',
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
