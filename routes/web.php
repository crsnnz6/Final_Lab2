<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $users = User::all();
        return view('dashboard',compact('users'));
    })->name('dashboard');
});

Route::get('/category', [CategoryController::class,'index'])->name('category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('add.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update'])->name('update.category');
Route::get('/category/remove/{id}', [CategoryController::class, 'remove']);
Route::get('category/restore/{id}', [CategoryController::class, 'restore']);
Route::get('category/delete/{id}', [CategoryController::class, 'delete']);

Route::get('brands', [BrandController::class, 'index'])->name('brands');
Route::post('/brand/add', [BrandController::class, 'add'])->name('add.brand');