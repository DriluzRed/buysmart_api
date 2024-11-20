<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\HomeController as HomeFrontController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\CustomerAuth\CustomerRegisterController;
use App\Http\Controllers\CustomerAuth\CustomerLoginController;
use App\Http\Middleware\Customer;
use App\Http\Controllers\Customerauth\CustomerResetPasswordController;
use App\Http\Controllers\ProductController as ProductController;

//admin routes






//client routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/register', [CustomerRegisterController::class, 'showRegistrationForm'])->name('customer.register');
Route::post('/register', [CustomerRegisterController::class, 'register']);
Route::get('/login', [CustomerLoginController::class, 'showLoginForm'])->name('customer.login');
Route::post('/login', [CustomerLoginController::class, 'login']);

Auth::routes(['register' => false, 'reset' => true, 'login' => false, 'verify' => false]);
//FAQ

Route::get('/faq', [App\Http\Controllers\InfoController::class, 'index'])->name('faq.index');
Route::get('/contacto', [App\Http\Controllers\InfoController::class, 'contact'])->name('contact.index');
Route::get('/acerca-de', [App\Http\Controllers\InfoController::class, 'about'])->name('about.index');
Route::get('/terminos-condiciones', [App\Http\Controllers\InfoController::class, 'terms'])->name('terms.index');

//products routes
Route::get('/productos', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/productos/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/ofertas', [App\Http\Controllers\ProductController::class, 'offers'])->name('products.offers');
Route::get('/search', [App\Http\Controllers\ProductController::class, 'searchProducts'])->name('products.search');
Route::get('/load-more-products', [ProductController::class, 'loadMoreProducts'])->name('load-more-products');

//categories routes
Route::get('/categorias', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
Route::get('/categorias/{slug}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');


//subcategories routes
Route::get('/sub-categorias', [App\Http\Controllers\SubcategoryController::class, 'index'])->name('subcategories.index');
Route::get('/sub-categorias/{slug}', [App\Http\Controllers\SubcategoryController::class, 'show'])->name('subcategories.show');

//brands routes


//cart routes
Route::get('/cart', [App\Http\Controllers\CartController::class, 'getCart']);
Route::post('/cart/add', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [App\Http\Controllers\CartController::class, 'updateCartItem']);
Route::post('/cart/remove', [App\Http\Controllers\CartController::class, 'removeFromCart']);

Route::get('/customer/change-password', [App\Http\Controllers\CustomerAuth\CustomerChangePasswordController::class, 'changePassword'])->name('customer.change-password')->middleware(Customer::class);
Route::post('/customer/change-password', [App\Http\Controllers\CustomerAuth\CustomerChangePasswordController::class, 'updatePassword'])->name('customer.update-password')->middleware(Customer::class);


Route::get('/customer/my-account', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.profile')->middleware(Customer::class);
Route::get('/customer/{id}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('customer.edit')->middleware(Customer::class);
Route::put('/customer/{id}', [App\Http\Controllers\CustomerController::class, 'update'])->name('customer.update')->middleware(Customer::class);
Route::get('/customer/my-orders', [App\Http\Controllers\CustomerController::class, 'orders'])->name('customer.orders')->middleware(Customer::class);;
Route::get('/customer/my-addresses/edit/{id}', [App\Http\Controllers\CustomerController::class, 'editAddress'])->name('customer.address.edit');
Route::get('/customer/my-addresses', [App\Http\Controllers\CustomerController::class, 'address'])->name('customer.address');
Route::get('/logout', [CustomerLoginController::class, 'logout'])->name('customer.logout');

Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'checkout'])->name('checkout')->middleware(Customer::class);
Route::post('/checkout/process', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.process')->middleware(Customer::class);
Route::get('/checkout/direct/{id}/{quantity}', [App\Http\Controllers\CheckoutController::class, 'directCheckout'])->name('checkout.direct')->middleware(Customer::class);
Route::post('/addresses', [App\Http\Controllers\AddressController::class, 'store'])->name('addresses.store')->middleware(Customer::class);
Route::put('/addresses/{id}', [App\Http\Controllers\AddressController::class, 'update'])->name('addresses.update')->middleware(Customer::class);
Route::delete('/addresses/{id}', [App\Http\Controllers\AddressController::class, 'destroy'])->name('addresses.destroy')->middleware(Customer::class);


Route::get('/get-cities', [App\Http\Controllers\AddressController::class, 'getCities'])->name('get-cities');
Route::get('/get-neighborhoods', [App\Http\Controllers\AddressController::class, 'getNeighborhoods'])->name('get-neighborhoods');
Route::get('/get-subcategories', [App\Http\Controllers\SubcategoryController::class, 'getSubcategories'])->name('get-subcategories');

Route::get('customer/password/reset', [CustomerResetPasswordController::class, 'showLinkRequestForm'])->name('customer.password.request');
Route::post('customer/password/email', [CustomerResetPasswordController::class, 'sendResetLinkEmail'])->name('customer.password.email');
Route::get('customer/password/reset/{token}', [CustomerResetPasswordController::class, 'showResetForm'])->name('customer.password.reset');
Route::post('customer/password/reset', [CustomerResetPasswordController::class, 'reset'])->name('customer.password.update');

Route::get('/customer/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('customer.orders')->middleware(Customer::class);
Route::get('/customer/orders/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('customer.order.show')->middleware(Customer::class);
Route::get('/order/success/{id}', function ($id) {
    return view('frontend.orders.order-success', compact('id'));
})->name('order.success')->middleware(Customer::class);


Route::get('politicas-de-seguridad', [App\Http\Controllers\InfoController::class, 'security'])->name('info.security-policy');
Route::get('terminos-de-servicio', [App\Http\Controllers\InfoController::class, 'terms'])->name('info.service-terms');
Route::get('faq', [App\Http\Controllers\InfoController::class, 'faq'])->name('info.faq');

//report routes
Route::post('reports/', [App\Http\Controllers\ReportController::class, 'run'])->name('report.download');


