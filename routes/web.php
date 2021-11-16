<?php

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

Route::get('/', function () {
    return view('auth.login');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

// Route::get('/category/makeup', function () {
//     return view('category.makeup');
// });

// Route::get('/', 'App\Http\Controllers\CategoryController@index');
Route::post('/category/add', 'App\Http\Controllers\CategoryController@store');
Route::get('/category/edit/{category_id}', 'App\Http\Controllers\CategoryController@edit');
Route::post('/category/update', 'App\Http\Controllers\CategoryController@update');
Route::post('/category/destroy', 'App\Http\Controllers\CategoryController@destroy');

Route::get('/category/name/{category_id}', 'App\Http\Controllers\SubcategoryController@categoryDetails');
Route::get('/category/makeup/{id}', 'App\Http\Controllers\SubcategoryController@index');
Route::post('/category/makeup/edit/{id}', 'App\Http\Controllers\SubcategoryController@edit');
Route::get('/category/subcategory/{id}', 'App\Http\Controllers\SubcategoryController@edit');
Route::post('/category/subcategory/update', 'App\Http\Controllers\SubcategoryController@update');
Route::post('/category/subcategory/add', 'App\Http\Controllers\SubcategoryController@store');
Route::post('/category/subcategory/destroy', 'App\Http\Controllers\SubcategoryController@destroy');

Route::get('/category/makeup/products/{category_id}/{sub}', 'App\Http\Controllers\ProductsController@index');
Route::get('/category/subcategory', 'App\Http\Controllers\ProductsController@subCategory');
Route::post('/category/product/add', 'App\Http\Controllers\ProductsController@store');
Route::post('/category/product/edit/{id}', 'App\Http\Controllers\ProductsController@edit');
Route::post('/category/product/update', 'App\Http\Controllers\ProductsController@update');
Route::post('/category/product/remove-image', 'App\Http\Controllers\ProductsController@removeImage');
Route::post('/category/product/remove-video', 'App\Http\Controllers\ProductsController@removeVideo');
Route::post('/category/product/delete-video', 'App\Http\Controllers\ProductsController@deleteVideo');
Route::post('/category/product/select-images', 'App\Http\Controllers\ProductsController@selectImages');
Route::post('/category/product/destroy', 'App\Http\Controllers\ProductsController@destroy');

Route::get('/themes', 'App\Http\Controllers\ThemesController@index');
Route::post('/themes/add', 'App\Http\Controllers\ThemesController@store');
Route::post('/themes/edit/{id}', 'App\Http\Controllers\ThemesController@edit');
Route::post('/themes/update', 'App\Http\Controllers\ThemesController@update');
Route::post('/themes/destroy', 'App\Http\Controllers\ThemesController@destroy');
Route::get('/themes/used/{id}', 'App\Http\Controllers\ThemesController@selectThemes');

Route::post('/store/add', 'App\Http\Controllers\StoreController@store');
Route::get('/stores', 'App\Http\Controllers\StoreController@index');
Route::get('/store/edit/{id}', 'App\Http\Controllers\StoreController@edit');
Route::post('/store/update', 'App\Http\Controllers\StoreController@update');
Route::get('/store/select/{id}', 'App\Http\Controllers\StoreController@selectStore');

Route::get('/users', 'App\Http\Controllers\UserAssignedStoreController@index');
Route::get('/users/edit/{userid}', 'App\Http\Controllers\UserAssignedStoreController@edit');
Route::post('/users/update', 'App\Http\Controllers\UserAssignedStoreController@update');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\CategoryController::class, 'index'])->name('dashboard');
Route::get('/cropper', [App\Http\Controllers\CropperController::class, 'index'])->name('cropper');
