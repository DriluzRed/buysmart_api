<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController as HomeFrontController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
//admin routes






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
Route::get('/cart', [App\Http\Controllers\CartController::class, 'getCart']);
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'addToCart']);
Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'removeFromCart']);

//checkout routes
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');



