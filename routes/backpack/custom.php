<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\CRUD.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('product', 'ProductCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('sub-category', 'SubCategoryCrudController');
    Route::crud('brand', 'BrandCrudController');
    Route::crud('order', 'OrderCrudController');
    Route::crud('department', 'DepartmentCrudController');
    Route::crud('city', 'CityCrudController');
    Route::crud('neighborhood', 'NeighborhoodCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('customer', 'CustomerCrudController');
    Route::crud('size', 'SizeCrudController');
    Route::crud('stock', 'StockCrudController');
}); // this should be the absolute last line of this file

/**
 * DO NOT ADD ANYTHING HERE.
 */
