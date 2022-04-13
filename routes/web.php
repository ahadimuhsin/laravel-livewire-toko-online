<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//view composer memanggil data tersebut di semua halaman
view()->composer('*', function ($view) {
    $global_categories = Category::latest()->take(6)->get();
    $view->with('global_categories', $global_categories);
});

Route::livewire('/', 'frontend.home.index')
->layout('layouts.frontend')
->name('root');

//cart
Route::livewire('cart', 'frontend.cart.index')
->layout('layouts.frontend')
->name('cart.index');

//payment after successful checkout
Route::livewire('payment/{invoice_id}', 'frontend.payment.index')
->layout('layouts.frontend')
->name('payment.index')
->middleware('auth:customer');

//category
Route::livewire('category/{slug}', 'frontend.category.show')
->layout('layouts.frontend')
->name('category');

//search
Route::livewire('search', 'frontend.search.index')
->layout('layouts.frontend')
->name('search');

Route::group(['middleware' => 'guest'], function(){
    //login page
    Route::livewire('/login', 'console.login')
    ->layout('layouts.auth')
    ->name('login');

    //logout
    Route::livewire('/logout', 'console.logout')
    ->layout('layouts.console')
    ->name('logout');

    /*
    Customer Auth
    */
    //Register
    Route::livewire('customer/register', 'customer.auth.register')
    ->layout('layouts.frontend')
    ->name('auth.customer.register');

    Route::livewire('customer/login', 'customer.auth.login')
    ->layout('layouts.frontend')
    ->name('auth.customer.login');
});

//grup admin
Route::prefix('console')->group(function(){
    Route::middleware(['auth'])->group(function () {
        //console dashboard
        Route::livewire('dashboard', 'console.dashboard.index')
        ->layout('layouts.console')
        ->name('dashboard');

        //Categories CRUD
        Route::livewire('/categories', 'console.categories.index')
        ->layout('layouts.console')
        ->name('categories.index');

        Route::livewire('/categories/create', 'console.categories.create')
        ->layout('layouts.console')
        ->name('categories.create');

        Route::livewire('/categories/edit/{id}', 'console.categories.edit')
        ->layout('layouts.console')
        ->name('categories.edit');

        //Products CRUD
        Route::livewire('products', 'console.products.index')
        ->layout('layouts.console')
        ->name('products.index');

        Route::livewire('products/create', 'console.products.create')
        ->layout('layouts.console')
        ->name('products.create');

        Route::livewire('products/edit/{id}', 'console.products.edit')
        ->layout('layouts.console')
        ->name('products.edit');

        //Vouchers CRUD
        Route::livewire('vouchers', 'console.vouchers.index')
        ->layout('layouts.console')
        ->name('vouchers.index');

        Route::livewire('vouchers/create', 'console.vouchers.create')
        ->layout('layouts.console')
        ->name('vouchers.create');

        Route::livewire('vouchers/edit/{id}', 'console.vouchers.edit')
        ->layout('layouts.console')
        ->name('vouchers.edit');

        //Orders
        Route::livewire('orders', 'console.orders.index')
        ->layout('layouts.console')
        ->name('orders.index');

        Route::livewire('orders/{id}', 'console.orders.show')
        ->layout('layouts.console')
        ->name('orders.show');

        Route::livewire('orders/status/{id}', 'console.orders.status')
        ->layout('layouts.console')
        ->name('orders.status');

        Route::livewire('orders/receipt/{id}', 'console.orders.receipt')
        ->layout('layouts.console')
        ->name('orders.receipt');

        //payment
        Route::livewire('payment', 'console.payment.index')
        ->layout('layouts.console')
        ->name('payments.index');

        Route::livewire('payment/{id}', 'console.payment.show')
        ->layout('layouts.console')
        ->name('payments.show');

        //Sliders
        Route::livewire('sliders', 'console.sliders.index')
        ->layout('layouts.console')
        ->name('sliders.index');

        //Users
        Route::livewire('users', 'console.users.index')
        ->layout('layouts.console')
        ->name('users.index');

        Route::livewire('users/create', 'console.users.create')
        ->layout('layouts.console')
        ->name('users.create');

        Route::livewire('users/edit/{id}', 'console.users.edit')
        ->layout('layouts.console')
        ->name('users.edit');


    });
});

//API
Route::get('/provinces', [ApiController::class, 'getProvinces']);
Route::get('/cities', [ApiController::class, 'getCities']);
Route::get('/districts', [ApiController::class, 'getDistricts']);
Route::post('/shipping', [ApiController::class, 'getShipping']);
Route::get('/check-voucher', [ApiController::class, 'checkVoucher']);
Route::post('/checkout', [ApiController::class, 'checkout']);
Route::post('/waybill', [ApiController::class, 'getWayBill']);

//grup customer
Route::prefix('customer')->group(function(){
    Route::group(['middleware' => 'auth:customer'], function(){
        //dashboard
        Route::livewire('dashboard', 'customer.dashboard.index')
        ->layout('layouts.frontend')
        ->name('customer.dashboard');

        //orders
        Route::livewire('orders', 'customer.orders.index')
        ->layout('layouts.frontend')
        ->name('customer.orders');

        Route::livewire('orders/{id}', 'customer.orders.show')
        ->layout('layouts.frontend')
        ->name('customer.orders.show');

        //Profile
        Route::livewire('profile', 'customer.profile.index')
        ->layout('layouts.frontend')
        ->name('customer.profile');
    });
});
