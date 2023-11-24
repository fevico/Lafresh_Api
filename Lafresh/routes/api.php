<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AdminController::class, 'store']);

// Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin-profile/{id}', 'AdminProfile')->name('admin-profile.show');
        Route::post('/admin-profile-update/{id}', 'AdminProfileUpdate')->name('admin-profile.update');
    });
    
    // product controller 
    Route::controller(ProductController::class)->group(function(){
        Route::get('/all-product', 'AllProfile')->name('all-product');
        Route::post('/add-product', 'AddProfile')->name('add-product');
        Route::post('/edit-product/{id}', 'EditProduct')->name('edit-product');
        Route::get('/delete-product/{id}', 'DeleteProduct')->name('delete-product');
    });

    // category controller 
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all-category', 'AllCategory')->name('all-category');
        Route::post('/add-category', 'AddCategory')->name('add-category');
        Route::post('/edit-category/{id}', 'EditCategory')->name('edit-category');
        Route::get('/delete-category/{id}', 'DeleteCategory')->name('delete-category');
    });
// });