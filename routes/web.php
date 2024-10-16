<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController as HomeFrontController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
//admin routes
Route::prefix('admin')->group(function () {
    // Ruta para el dashboard de administración
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home');

    // Rutas para la gestión de categorías
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Rutas para la gestión de productos
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});






//client routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
//FAQ
Route::get('/faq', [App\Http\Controllers\InfoController::class, 'index'])->name('faq.index');
Route::get('/contact', [App\Http\Controllers\InfoController::class, 'contact'])->name('contact.index');
Route::get('/about', [App\Http\Controllers\InfoController::class, 'about'])->name('about.index');
Route::get('/terms', [App\Http\Controllers\InfoController::class, 'terms'])->name('terms.index');

//products routes
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/offers', [App\Http\Controllers\ProductController::class, 'offers'])->name('products.offers');
Route::get('/search', [App\Http\Controllers\ProductController::class, 'searchProducts'])->name('products.search');


//categories routes
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');

//subcategories routes
Route::get('/subcategories', [App\Http\Controllers\SubcategoryController::class, 'index'])->name('subcategories.index');
Route::get('/subcategories/{slug}', [App\Http\Controllers\SubcategoryController::class, 'show'])->name('subcategories.show');

//brands routes


//cart routes
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{rowId}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
Route::patch('/cart/{rowId}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');

