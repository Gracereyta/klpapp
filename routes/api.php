<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', 'App\Http\Controllers\ApiController@categories');
Route::get('/category/{category_id}', 'App\Http\Controllers\ApiController@category');
Route::get('/sub-categories/{category_id}', 'App\Http\Controllers\ApiController@subCategories');
Route::get('/products/{category_id}/{sub_categoryid}', 'App\Http\Controllers\ApiController@products');
Route::get('/one-product/{product_id}', 'App\Http\Controllers\ApiController@oneProduct');
Route::get('/sub-category/{category_id}', 'App\Http\Controllers\ApiController@subCategory');
Route::get('/product-images/{product_id}', 'App\Http\Controllers\ApiController@productImages');
Route::get('/themes', 'App\Http\Controllers\ApiController@themes');
Route::get('/sub-categories', 'App\Http\Controllers\ApiController@allSubCategories');
Route::get('/allProducts', 'App\Http\Controllers\ApiController@allProducts');
Route::get('/oneProductNew', 'App\Http\Controllers\ApiController@oneProductNew');

Route::get('lifestyle/categories', 'App\Http\Controllers\LifestyleApiController@categories');
Route::get('lifestyle/category/{category_id}', 'App\Http\Controllers\LifestyleApiController@category');
Route::get('lifestyle/sub-categories/{category_id}', 'App\Http\Controllers\LifestyleApiController@subCategories');
Route::get('lifestyle/products/{category_id}', 'App\Http\Controllers\LifestyleApiController@products');
Route::get('lifestyle/one-product/{product_id}', 'App\Http\Controllers\LifestyleApiController@oneProduct');
Route::get('lifestyle/sub-category/{category_id}', 'App\Http\Controllers\LifestyleApiController@subCategory');
Route::get('lifestyle/product-images/{product_id}', 'App\Http\Controllers\LifestyleApiController@productImages');
Route::get('lifestyle/themes', 'App\Http\Controllers\LifestyleApiController@themes');
Route::get('/lifestyle/products', 'App\Http\Controllers\LifestyleApiController@allProducts');

Route::get('pyt/categories', 'App\Http\Controllers\PYTApiController@categories');
Route::get('pyt/category/{category_id}', 'App\Http\Controllers\PYTApiController@category');
Route::get('pyt/sub-categories/{category_id}', 'App\Http\Controllers\PYTApiController@subCategories');
Route::get('pyt/products/{category_id}', 'App\Http\Controllers\PYTApiController@products');
Route::get('pyt/one-product/{product_id}', 'App\Http\Controllers\PYTApiController@oneProduct');
Route::get('pyt/sub-category/{category_id}', 'App\Http\Controllers\PYTApiController@subCategory');
Route::get('pyt/product-images/{product_id}', 'App\Http\Controllers\PYTApiController@productImages');
Route::get('pyt/themes', 'App\Http\Controllers\PYTApiController@themes');
Route::get('pyt/products', 'App\Http\Controllers\PYTApiController@allProducts');
Route::get('pyt/products/{category_id}/{sub_categoryid}', 'App\Http\Controllers\PYTApiController@products_special');
Route::get('pyt/sub-categories', 'App\Http\Controllers\PYTApiController@allSubCategories');
Route::get('pyt/oneProductNew', 'App\Http\Controllers\PYTApiController@oneProductNew');

Route::get('stmesa/categories', 'App\Http\Controllers\SantaMesaController@categories');
Route::get('stmesa/category/{category_id}', 'App\Http\Controllers\SantaMesaController@category');
Route::get('stmesa/sub-categories/{category_id}', 'App\Http\Controllers\SantaMesaController@subCategories');
Route::get('stmesa/products/{category_id}/{sub_categoryid}', 'App\Http\Controllers\SantaMesaController@products');
Route::get('stmesa/one-product/{product_id}', 'App\Http\Controllers\SantaMesaController@oneProduct');
Route::get('stmesa/sub-category/{category_id}', 'App\Http\Controllers\SantaMesaController@subCategory');
Route::get('stmesa/product-images/{product_id}', 'App\Http\Controllers\SantaMesaController@productImages');
Route::get('stmesa/themes', 'App\Http\Controllers\SantaMesaController@themes');
Route::get('stmesa/sub-categories', 'App\Http\Controllers\SantaMesaController@allSubCategories');
Route::get('stmesa/allProducts', 'App\Http\Controllers\SantaMesaController@allProducts');
Route::get('stmesa/oneProductNew', 'App\Http\Controllers\SantaMesaController@oneProductNew');

Route::get('greenbeltBP/categories', 'App\Http\Controllers\GreenbeltBPController@categories');
Route::get('greenbeltBP/category/{category_id}', 'App\Http\Controllers\GreenbeltBPController@category');
Route::get('greenbeltBP/sub-categories/{category_id}', 'App\Http\Controllers\GreenbeltBPController@subCategories');
Route::get('greenbeltBP/products/{category_id}/{sub_categoryid}', 'App\Http\Controllers\GreenbeltBPController@products');
Route::get('greenbeltBP/one-product/{product_id}', 'App\Http\Controllers\GreenbeltBPController@oneProduct');
Route::get('greenbeltBP/sub-category/{category_id}', 'App\Http\Controllers\GreenbeltBPController@subCategory');
Route::get('greenbeltBP/product-images/{product_id}', 'App\Http\Controllers\GreenbeltBPController@productImages');
Route::get('greenbeltBP/themes', 'App\Http\Controllers\GreenbeltBPController@themes');
Route::get('greenbeltBP/sub-categories', 'App\Http\Controllers\GreenbeltBPController@allSubCategories');
Route::get('greenbeltBP/allProducts', 'App\Http\Controllers\GreenbeltBPController@allProducts');
Route::get('greenbeltBP/oneProductNew', 'App\Http\Controllers\GreenbeltBPController@oneProductNew');

Route::get('makaticircuit/categories', 'App\Http\Controllers\MakatiCircuitController@categories');
Route::get('makaticircuit/category/{category_id}', 'App\Http\Controllers\MakatiCircuitController@category');
Route::get('makaticircuit/sub-categories/{category_id}', 'App\Http\Controllers\MakatiCircuitController@subCategories');
Route::get('makaticircuit/products/{category_id}/{sub_categoryid}', 'App\Http\Controllers\MakatiCircuitController@products');
Route::get('makaticircuit/one-product/{product_id}', 'App\Http\Controllers\MakatiCircuitController@oneProduct');
Route::get('makaticircuit/sub-category/{category_id}', 'App\Http\Controllers\MakatiCircuitController@subCategory');
Route::get('makaticircuit/product-images/{product_id}', 'App\Http\Controllers\MakatiCircuitController@productImages');
Route::get('makaticircuit/themes', 'App\Http\Controllers\MakatiCircuitController@themes');
Route::get('makaticircuit/sub-categories', 'App\Http\Controllers\MakatiCircuitController@allSubCategories');
Route::get('makaticircuit/allProducts', 'App\Http\Controllers\MakatiCircuitController@allProducts');
Route::get('makaticircuit/oneProductNew', 'App\Http\Controllers\MakatiCircuitController@oneProductNew');

Route::get('smbfparanaque/categories', 'App\Http\Controllers\SMBFParanqueController@categories');
Route::get('smbfparanaque/category/{category_id}', 'App\Http\Controllers\SMBFParanqueController@category');
Route::get('smbfparanaque/sub-categories/{category_id}', 'App\Http\Controllers\SMBFParanqueController@subCategories');
Route::get('smbfparanaque/products/{category_id}/{sub_categoryid}', 'App\Http\Controllers\SMBFParanqueController@products');
Route::get('smbfparanaque/one-product/{product_id}', 'App\Http\Controllers\SMBFParanqueController@oneProduct');
Route::get('smbfparanaque/sub-category/{category_id}', 'App\Http\Controllers\SMBFParanqueController@subCategory');
Route::get('smbfparanaque/product-images/{product_id}', 'App\Http\Controllers\SMBFParanqueController@productImages');
Route::get('smbfparanaque/themes', 'App\Http\Controllers\SMBFParanqueController@themes');
Route::get('smbfparanaque/sub-categories', 'App\Http\Controllers\SMBFParanqueController@allSubCategories');
Route::get('smbfparanaque/allProducts', 'App\Http\Controllers\SMBFParanqueController@allProducts');
Route::get('smbfparanaque/oneProductNew', 'App\Http\Controllers\SMBFParanqueController@oneProductNew');

Route::get('luckychinatown/categories', 'App\Http\Controllers\LuckyChinaTownController@categories');
Route::get('luckychinatown/category/{category_id}', 'App\Http\Controllers\LuckyChinaTownController@category');
Route::get('luckychinatown/sub-categories/{category_id}', 'App\Http\Controllers\LuckyChinaTownController@subCategories');
Route::get('luckychinatown/products/{category_id}/{sub_categoryid}', 'App\Http\Controllers\LuckyChinaTownController@products');
Route::get('luckychinatown/one-product/{product_id}', 'App\Http\Controllers\LuckyChinaTownController@oneProduct');
Route::get('luckychinatown/sub-category/{category_id}', 'App\Http\Controllers\LuckyChinaTownController@subCategory');
Route::get('luckychinatown/product-images/{product_id}', 'App\Http\Controllers\LuckyChinaTownController@productImages');
Route::get('luckychinatown/themes', 'App\Http\Controllers\LuckyChinaTownController@themes');
Route::get('luckychinatown/sub-categories', 'App\Http\Controllers\LuckyChinaTownController@allSubCategories');
Route::get('luckychinatown/allProducts', 'App\Http\Controllers\LuckyChinaTownController@allProducts');
Route::get('luckychinatown/oneProductNew', 'App\Http\Controllers\LuckyChinaTownController@oneProductNew');

Route::get('smeastortigas/categories', 'App\Http\Controllers\SMEastOrtigasController@categories');
Route::get('smeastortigas/category/{category_id}', 'App\Http\Controllers\SMEastOrtigasController@category');
Route::get('smeastortigas/sub-categories/{category_id}', 'App\Http\Controllers\SMEastOrtigasController@subCategories');
Route::get('smeastortigas/products/{category_id}/{sub_categoryid}', 'App\Http\Controllers\SMEastOrtigasController@products');
Route::get('smeastortigas/one-product/{product_id}', 'App\Http\Controllers\SMEastOrtigasController@oneProduct');
Route::get('smeastortigas/sub-category/{category_id}', 'App\Http\Controllers\SMEastOrtigasController@subCategory');
Route::get('smeastortigas/product-images/{product_id}', 'App\Http\Controllers\SMEastOrtigasController@productImages');
Route::get('smeastortigas/themes', 'App\Http\Controllers\SMEastOrtigasController@themes');
Route::get('smeastortigas/sub-categories', 'App\Http\Controllers\SMEastOrtigasController@allSubCategories');
Route::get('smeastortigas/allProducts', 'App\Http\Controllers\SMEastOrtigasController@allProducts');
Route::get('smeastortigas/oneProductNew', 'App\Http\Controllers\SMEastOrtigasController@oneProductNew');

Route::get('uptowncenter/categories', 'App\Http\Controllers\UptownCenterController@categories');
Route::get('uptowncenter/category/{category_id}', 'App\Http\Controllers\UptownCenterController@category');
Route::get('uptowncenter/sub-categories/{category_id}', 'App\Http\Controllers\UptownCenterController@subCategories');
Route::get('uptowncenter/products/{category_id}/{sub_categoryid}', 'App\Http\Controllers\UptownCenterController@products');
Route::get('uptowncenter/one-product/{product_id}', 'App\Http\Controllers\UptownCenterController@oneProduct');
Route::get('uptowncenter/sub-category/{category_id}', 'App\Http\Controllers\UptownCenterController@subCategory');
Route::get('uptowncenter/product-images/{product_id}', 'App\Http\Controllers\UptownCenterController@productImages');
Route::get('uptowncenter/themes', 'App\Http\Controllers\UptownCenterController@themes');
Route::get('uptowncenter/sub-categories', 'App\Http\Controllers\UptownCenterController@allSubCategories');
Route::get('uptowncenter/allProducts', 'App\Http\Controllers\UptownCenterController@allProducts');
Route::get('uptowncenter/oneProductNew', 'App\Http\Controllers\UptownCenterController@oneProductNew');



