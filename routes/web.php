<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('demo', [AdminController::class, 'demo'])->name('admin.demo');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('demo',)
Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin', 'auth']], function(){
    //Route::get('/delete/{id}', [AdminController::class, 'destroy'])->name('delete');
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('products', [AdminController::class, 'product'])->name('admin.products');
    Route::get('categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('user', [AdminController::class, 'user'])->name('admin.user');
    Route::get('menus', [AdminController::class, 'menus'])->name('admin.menus');
    Route::post('menu', [AdminController::class, 'menu'])->name('admin.menu');
    Route::get('create', [AdminController::class, 'create'])->name('admin.create');
    Route::get('createcategories', [AdminController::class, 'createcategories'])->name('admin.createcategories');
    Route::post('categoriesstore', [AdminController::class, 'categoriesstore'])->name('admin.categoriesstore');
    Route::post('store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
    Route::post('update/{id}',[AdminController::class, 'update'])->name('admin.update');
    Route::post('delete-multiple-products',[AdminController::class, 'deletemultipleproducts'])->name('admin.multiple-delete'); 
    Route::get('pdf', [AdminController::class, 'pdf'])->name('admin.pdf');
    Route::get('excel', [AdminController::class, 'ExportExcel'])->name('admin.excel');
    //Route::get('dashboards.admins.products/pdf', 'AdminController@pdf');
    //Route::get('export', [AdminController::class, 'export'])->name('export');
    Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('settings', [AdminController::class, 'settings'])->name('admin.settings');
});
Route::group(['prefix'=>'user', 'middleware'=>['isUser', 'auth']], function(){
    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('settings', [UserController::class, 'settings'])->name('user.settings');
});