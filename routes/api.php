<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});




Route::apiResource('/employee','Api\EmployeeController');
Route::apiResource('/supplier','Api\SupplierController');
Route::apiResource('/customer','Api\CustomerController');
Route::apiResource('/category','Api\CategoryController');
Route::apiResource('/product','Api\ProductController');
Route::apiResource('/expense','Api\ExpenseController');

Route::Post('/salary/paid/{id}','Api\SalaryController@paySalary');
Route::Get('/salary','Api\SalaryController@allSalary');
Route::Get('/view-salary/{id}','Api\SalaryController@allMonthSalary');
Route::Get('/edit-salary/{id}','Api\SalaryController@editSalary');
Route::Post('/salary/update/{id}','Api\SalaryController@updateSalary');
Route::Post('/stock/update/{id}','Api\SalaryController@updateStock');


Route::Get('/getting/product/{id}','Api\PosController@getProduct');
Route::Post('/orderdone','Api\PosController@orderdone');

//cart
Route::Get('/addTocart/{id}','Api\CartController@getProduct');
Route::Get('/cart/product','Api\CartController@getCartProduct');
Route::Get('remove/cart/{id}','Api\CartController@removeCartProductById');
Route::Get('/increment/{id}','Api\CartController@incrementCartProductById');
Route::Get('/decrement/{id}','Api\CartController@decrementCartProductById');
Route::Get('/vats','Api\CartController@vats');

//order
Route::Get('/order','Api\OrderController@getOrder');
Route::Get('/order/details/{id}','Api\OrderController@getOrderDetails');
Route::Get('/order/orderdetails/{id}','Api\OrderController@getAllOrderDetails');
//Search
Route::Post('/search/date','Api\OrderController@searchDate');
Route::Post('/search/month','Api\OrderController@searchMonth');
Route::Get('/today-sell','Api\OrderController@todaySell');
Route::Get('/today-income','Api\OrderController@todayIncome');
Route::Get('/today-due','Api\OrderController@todayDue');
Route::Get('/today-expense','Api\OrderController@todayExpense');
Route::Get('/product-out','Api\OrderController@stockOut');


