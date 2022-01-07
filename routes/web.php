<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\singleproductcontroller;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');







// Route::get('/', function () {
//     return redirect()->route('login');
// });


Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth', 'preventBackHistory']], function () {

    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');


    //Change password
    Route::post('updatePassword', [PasswordChangeController::class, 'changePassword']);


//designation

Route::post('add-designation', [DesignationController::class, 'addDesignation']);
Route::get('get-designations', [DesignationController::class, 'getDesignation']);
Route::post('delete-designation', [DesignationController::class, 'deleteDesignation']);

// employee 
Route::post('add-employee', [EmployeeController::class, 'addEmployee']);
Route::get('get-employees', [EmployeeController::class, 'getEmployees']);
Route::post('delete-employee', [EmployeeController::class, 'deleteEmployee']);

//customer
Route::post('add-customer', [CustomerController::class, 'addCustomer']);
Route::get('get-customers', [CustomerController::class, 'getCustomers']);
Route::post('delete-customer', [CustomerController::class, 'deleteCustomer']);



});


Route::get('/',[UserController::class,'index']);
Route::get('/products',[Singleproductcontroller::class,'prod']);
Route::get('/singleproduct',[Singleproductcontroller::class,'pro']);
Route::get('/services',[ServiceController::class,'serv']);

