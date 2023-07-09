<?php

use App\Http\Controllers\AdminCustomer;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminSalesController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SettingController;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAddonController;
use App\Http\Controllers\AdminPenayanganController;
use App\Http\Controllers\AdminTheaterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberOrders;
use App\Http\Controllers\MemberTiketController;
use App\Http\Controllers\OrderAjaxController;
use App\Http\Controllers\PaymentCallbackController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TicketController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/movie/{id}', [DetailController::class, 'index']);

Route::get('/login', [LoginController::class, 'index']);
Route::get('/register', [RegisterController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);
Route::post('search', [AjaxController::class, 'ajaxSearch'])->name('search');
Route::get('search', [SearchController::class, 'index']);

//route admin 
Route::middleware('admin')->group(function () {
    Route::resource('/dashboard/sales', AdminSalesController::class);
    Route::resource('/dashboard/orders', AdminOrderController::class);
    Route::resource('/dashboard/customers', AdminCustomer::class);
    Route::get('/dashboard/addon', [AdminAddonController::class, 'index'])->name("dashboard.admin.addon.index");
    Route::post('/dashboard/addon/store', [AdminAddonController::class, 'store'])->name("dashboard.admin.addon.store");
    Route::delete('/dashboard/addon/{id}/delete', [AdminAddonController::class, 'delete'])->name("dashboard.admin.addon.delete");
    Route::get('/dashboard/addon/{id}/edit', [AdminAddonController::class, 'edit'])->name("dashboard.admin.addon.edit");
    Route::put('/dashboard/addon/{id}/update', [AdminAddonController::class, 'update'])->name("dashboard.admin.addon.update");
    Route::get('/dashboard/penayangan', [AdminPenayanganController::class, 'index'])->name("dashboard.admin.penayangan.index");
    Route::post('/dashboard/penayangan/store', [AdminPenayanganController::class, 'store'])->name("dashboard.admin.penayangan.store");
    Route::delete('/dashboard/penayangan/{id}/delete', [AdminPenayanganController::class, 'delete'])->name("dashboard.admin.penayangan.delete");
    Route::get('/dashboard/penayangan/{id}/edit', [AdminPenayanganController::class, 'edit'])->name("dashboard.admin.penayangan.edit");
    Route::put('/dashboard/penayangan/{id}/update', [AdminPenayanganController::class, 'update'])->name("dashboard.admin.penayangan.update");
    Route::get('/dashboard/theater', [AdminTheaterController::class, 'index'])->name("dashboard.admin.theater.index");
    Route::post('/dashboard/theater/store', [AdminTheaterController::class, 'store'])->name("dashboard.admin.theater.store");
    Route::delete('/dashboard/theater/{id}/delete', [AdminTheaterController::class, 'delete'])->name("dashboard.admin.theater.delete");
    Route::get('/dashboard/theater/{id}/edit', [AdminTheaterController::class, 'edit'])->name("dashboard.admin.theater.edit");
    Route::put('/dashboard/theater/{id}/update', [AdminTheaterController::class, 'update'])->name("dashboard.admin.theater.update");
});

// route auth
Route::middleware('auth')->group(function () {
    //order
    Route::get('/order', [OrderController::class, 'index']);
    Route::post('/pay', [OrderController::class, 'insertData']);
    Route::post('/payment', [OrderController::class, 'order']);
    Route::get('/payment', [OrderController::class, 'order']);
    Route::controller(OrderAjaxController::class)->group(function () {
        Route::post('order-ajax-pending-payment', 'pendingPayment')->name('order.pending.payment');
        Route::post('order-ajax-success-payment', 'successPayment')->name('order.success.payment');
        Route::post('order-ajax-dates', 'dates')->name('order.dates');
        Route::post('order-ajax-theaters', 'theaters')->name('order.theaters');
        Route::post('order-ajax-times', 'times')->name('order.times');
        Route::post('order-ajax-prices', 'prices')->name('order.prices');
        Route::post('order-ajax-seats', 'seats')->name('order.seats');
    });

    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('/dashboard/member/orders', MemberOrders::class);
    Route::resource('/dashboard/member/tiket', MemberTiketController::class);
    Route::resource('/dashboard/member/setting', SettingController::class);
    Route::resource('/dashboard/setting', SettingController::class);
    Route::resource('/dashboard/member/password', PasswordController::class);
    Route::resource('/dashboard/password', PasswordController::class);
    Route::get('/dashboard/tiket/{id}', [TicketController::class, 'index']);
});
