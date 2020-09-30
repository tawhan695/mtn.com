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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:Manager')->group(function () {   // (ุ้จัดการ)
    Route::resource('/users','Usercontroller',['except'=> ['store']]);
    Route::resource('/employee','EmployeeController');
    Route::resource('/dashborad','DashboradController');
    // สินค้า
    Route::resource('/ImportProducts','ImportProductsController');
    Route::resource('/ReturnProducts','ReturnProductsController');
    Route::resource('/ChangeProducts','ChangeProductsController');
    Route::resource('/DefectiveProducts','DefectiveProductsController');
    Route::resource('/StockProducts','StockProductsController');
    Route::resource('/TypeProducts','TypeProductsController');
    //ขาย
    Route::resource('/saler','SalerController');


});
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:BranchManagerAssistant')->group(function () {   //ผู้ช่วยผุ้จัดการ
    //พนักงาน
    Route::resource('/employee','EmployeeController');
    // สินค้า
    Route::resource('/ImportProducts','ImportProductsController');
    Route::resource('/ReturnProducts','ReturnProductsController');
    Route::resource('/ChangeProducts','ChangeProductsController');
    Route::resource('/DefectiveProducts','DefectiveProductsController');
    Route::resource('/StockProducts','StockProductsController');
    Route::resource('/TypeProducts','TypeProductsController');
      //ขาย
    Route::resource('/saler','SalerController');
    Route::resource('/salers','SalerMController');
});
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:Salesperson')->group(function () {   // พนักงานขาย
    //พนักงาน
    Route::resource('/employee','EmployeeController');
    // สินค้า
    Route::resource('/ImportProducts','ImportProductsController');
    Route::resource('/ReturnProducts','ReturnProductsController');
    Route::resource('/ChangeProducts','ChangeProductsController');
    Route::resource('/DefectiveProducts','DefectiveProductsController');
    Route::resource('/StockProducts','StockProductsController');
    Route::resource('/TypeProducts','TypeProductsController');
    //ขาย
    Route::resource('/saler','SalerController');
    Route::resource('/salers','SalerMController');
});
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:DeliveryStaff')->group(function () {   // พนักงานขับรถ
    // Route::resource('/employee','EmployeeController');
});
Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:GeneralStaff')->group(function () {   // พนักงานทั่่วไป
    // Route::resource('/employee','EmployeeController');
});
