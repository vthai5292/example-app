<?php

use App\Http\Controllers\DemoController;
use App\Http\Livewire\Admin\AdminDashboardComponent;

use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', HomeComponent::class)->name('Home');
Route::get('/shop', ShopComponent::class)->name('Shop');
Route::get('/cart', CartComponent::class)->name('Cart');
Route::get('/checkout', CheckoutComponent::class)->name('Checkout');
Route::get('/detail/{slug}', DetailsComponent::class)->name('detail');
Route::get('/search', SearchComponent::class)->name('search');
Route::post('/demo', [DemoController::class, 'index'])->name('demo');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
Route::middleware(['auth:sanctum', config('jetstream.auth_session', 'verified', 'authadmin')])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
});
Route::middleware(['auth:sanctum', config('jetstream.auth_session', 'verified')])->group(function () {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
});
