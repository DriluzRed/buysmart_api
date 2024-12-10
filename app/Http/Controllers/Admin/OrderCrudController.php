<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrderCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Order::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order');
        CRUD::setEntityNameStrings('pedido', 'pedidos');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
       $this->crud->removeButton('create');
       $this->crud->removeButton('delete');
        CRUD::addColumn([
            'name' => 'customer_id',
            'type' => 'select',
            'label' => 'Cliente',
            'attribute' => 'name',
            'entity' => 'customer',
            'model' => \App\Models\Customer::class,
            
        ]);
        CRUD::addColumn([
            'name' => 'status',
            'type' => 'enum',
            'label' => 'Estado',
            'options' => [
                'pending' => 'Pendiente',
                'processed' => 'Procesado',
                'shipped' => 'Enviado',
                'delivered' => 'Entregado',
                'canceled' => 'Cancelado',
                'finished' => 'Finalizado',
                'returned' => 'Devuelto',
                'refunded' => 'Reembolsado',
            ],
        ]);
        CRUD::addColumn([
            'name' => 'payment_method_id',
            'type' => 'select',
            'label' => 'Metodo de pago',
            'attribute' => 'name',
            'entity' => 'paymentMethod',
            'model' => \App\Models\PaymentMethod::class,
           
        ]);
        CRUD::addColumn([
            'name' => 'payment_status',
            'type' => 'enum',
            'label' => 'Estado de pago',
            'options' => ['pending' => 'Pendiente', 'completed' => 'Completado', 'canceled' => 'Cancelado', 'refunded' => 'Reembolsado', 'failed' => 'Fallido', 'processing' => 'Procesando', 'confirmed' => 'Confirmado','paid' => 'Pagado'],
        ]);
        CRUD::addColumn([
            'name' => 'address_id',
            'type' => 'select',
            'label' => 'Direccion de envio',
            'attribute' => 'full_address',
            'entity' => 'address',
            'model' => \App\Models\Address::class,
        ]);

        CRUD::addColumn([
            'name' => 'formatted_total',
            'type' => 'text',
            'label' => 'Total',
        ]);
        $this->crud->addColumn([
            'name'  => 'created_at',
            'type'  => 'text',
            'label' => 'Fecha de creacion',
        ]);
        $this->crud->addColumn([
            'name'  => 'updated_at',
            'type'  => 'text',
            'label' => 'Fecha de actualizacion',
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
        CRUD::setValidation(OrderRequest::class);
        
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(OrderRequest::class);

        CRUD::field('status')->type('enum')->label('Estado')->options([
            'pending' => 'Pendiente',
            'processed' => 'Procesado',
            'shipped' => 'Enviado',
            'delivered' => 'Entregado',
            'canceled' => 'Cancelado',
            'finished' => 'Finalizado',
            'returned' => 'Devuelto',
            'refunded' => 'Reembolsado',
        ]);

        CRUD::addField([
            'name' => 'payment_status',
            'type' => 'enum',
            'label' => 'Estado de pago',
            'options' => ['pending' => 'Pendiente', 'completed' => 'Completado', 'canceled' => 'Cancelado', 'refunded' => 'Reembolsado', 'failed' => 'Fallido', 'processing' => 'Procesando', 'confirmed' => 'Confirmado','paid' => 'Pagado'],
        ]);
        
    }

    public function setupShowOperation()
    {
        $this->setupListOperation();
        // En OrderCrudController.php
        $this->crud->addColumn([
            'name'  => 'customer_phone',
            'type'  => 'text',
            'label' => 'Telefono del Cliente',
            'attribute' => 'phone',
            'entity' => 'customer',
            'model' => \App\Models\Customer::class,
        ]);
        $this->crud->addColumn([
            'name'  => 'items',
            'type'  => 'custom_html',
            'label' => 'Items de la Orden',
            'value' => function ($order) {
                $html = '<table class="table table-bordered"><thead><tr>
                            <th></th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr></thead><tbody>';
                foreach ($order->items as $item) {
                    $image = asset('storage/'.$item->product->main_image);
                    $subtotal = $item->quantity * $item->price;
                    $html .= "<tr>
                                <td><img src='{$image}' style='width: 50px; height: 50px;'></td>
                                <td>{$item->product->name}</td>
                                <td>{$item->quantity}</td>
                                <td>Gs. {$item->price}</td>
                                <td>Gs. {$subtotal}</td>
                            </tr>";
                }
                $html .= '</tbody></table>';
                return $html;
            },
        ]);
        $this->crud->addColumn([
            'name'  => 'created_at',
            'type'  => 'text',
            'label' => 'Fecha de creacion',
        ]);
        $this->crud->addColumn([
            'name'  => 'updated_at',
            'type'  => 'text',
            'label' => 'Fecha de actualizacion',
        ]);
        

    }
}
