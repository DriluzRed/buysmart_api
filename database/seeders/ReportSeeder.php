<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Report::create([
            'name' => 'Reporte de ventas',
            'custom_query' => 'SELECT 
                orders.customer_id AS ClienteID,
                COUNT(*) AS TotalPedidos,
                SUM(subtotal) AS Subtotal,
                SUM(additional_charges) AS CargosAdicionales,
                SUM(total) AS TotalIngresos,
                payment_method_id AS MetodoPago,
                payment_status AS EstadoPago,
                status AS EstadoPedido,
                CONCAT(address_line_1, ' - ', address_line_2) AS direccion
            FROM 
                orders
            JOIN payment_methods on orders.payment_method_id = payment_methods.id
            LEFT JOIN addresses on addresses.id = orders.address_id
            WHERE 
                orders.deleted_at IS NULL
                    [DATERANGE]
            GROUP BY 
                orders.customer_id, payment_method_id, payment_status, status, address_id
            ORDER BY 
                TotalIngresos DESC;
            ',
            'variables' => '{"DATERANGE": {"fields": {"orders": "created_at"}}}',
        ]);

        \App\Models\Report::create([
            'name' => 'Reporte de ventas',
            'custom_query' => "SELECT 
                orders.customer_id AS ClienteID,
                COUNT(*) AS TotalPedidos,
                SUM(subtotal) AS Subtotal,
                SUM(additional_charges) AS CargosAdicionales,
                SUM(total) AS TotalIngresos,
                payment_method_id AS MetodoPago,
                payment_status AS EstadoPago,
                status AS EstadoPedido,
                CONCAT(address_line_1, ' - ', address_line_2) AS direccion
            FROM 
                orders
            JOIN payment_methods on orders.payment_method_id = payment_methods.id
            LEFT JOIN addresses on addresses.id = orders.address_id
            WHERE 
                orders.deleted_at IS NULL
                    [DATERANGE]
            GROUP BY 
                orders.customer_id, payment_method_id, payment_status, status, address_id
            ORDER BY 
                TotalIngresos DESC;",
            'variables' => '{"DATERANGE": {"fields": {"orders": "created_at"}}}',
        ]);

        \App\Models\Report::create([
            'name' => 'Reporte de Ingresos por Categorias',
            'custom_query' => 'SELECT 
                categories.name AS Categoria,
                SUM(order_items.quantity) AS Cantidad_Total_Vendida,
                SUM(order_items.quantity * order_items.price) AS Total_Ingresos,
                COUNT(DISTINCT products.id) AS Productos_Vendidos
            FROM 
                order_items
            JOIN 
                products ON order_items.product_id = products.id
            LEFT JOIN 
                categories ON products.category_id = categories.id
            WHERE order_items.deleted_at IS NULL
                    [DATERANGE]
            GROUP BY 
                categories.name
            ORDER BY 
            Total_Ingresos DESC;',
            'variables' => '{"DATERANGE": {"fields": {"order_items": "created_at"}}}',
        ]);
    }
}
