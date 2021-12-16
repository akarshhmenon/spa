<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseLogController;
use App\Http\Controllers\PurchaseReportsController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RewardSaleController;
use App\Http\Controllers\AdjustmentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\IncomeCategoryController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\JobcardController;
use App\Http\Controllers\LoginPageController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'superadmin', 'middleware' => 'auth'], function () {
    Route::get('dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
});

Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth', 'preventBackHistory']], function () {

    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');


    //Change password
    Route::post('updatePassword', [PasswordChangeController::class, 'changePassword']);
});


Route::get('/',[UserController::class,'index']);
