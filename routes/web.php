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

    Route::post('/add-customer', [CustomerController::class, 'save']);
    Route::get('/get-customers', [CustomerController::class, 'getCustomers']);


    Route::post('/delete-customer', [CustomerController::class, 'deleteCustomer']);

    Route::post('/add-product', [ProductController::class, 'save']);
    Route::get('/get-products', [ProductController::class, 'getProducts']);
    Route::post('/delete-product', [ProductController::class, 'deleteProduct']);

    Route::get('/get-stock-report', [ProductController::class, 'getStockProducts']);

    Route::get('/product-categories', [CategoryController::class, 'getCategory']);


    Route::post('/add-sale', [SaleController::class, 'save']);
    Route::get('/get-sales', [SaleController::class, 'getSales']);

    Route::get('/get-today-sales', [SaleController::class, 'getTodaySales']);
    Route::post('/delete-sale', [SaleController::class, 'deleteSale']);

    Route::post('/add-purchase', [PurchaseLogController::class, 'save']);
    Route::get('/get-purchases', [PurchaseLogController::class, 'getPurchases']);
    Route::get('/get-today-purchases', [PurchaseLogController::class, 'getTodayPurchases']);

    Route::post('/delete-purchase', [PurchaseLogController::class, 'deletePurchase']);

    Route::post('/add-payment', [PaymentController::class, 'save']);
    Route::get('/get-payments', [PaymentController::class, 'getPayments']);
    Route::post('/delete-payment', [PaymentController::class, 'deletePayment']);

    Route::post('/add-adjustment', [AdjustmentController::class, 'save']);
    Route::get('/get-adjustments', [AdjustmentController::class, 'getAdjustments']);
    Route::post('/delete-adjustment', [AdjustmentController::class, 'deleteAdjustment']);

    Route::post('/add-rewardsale', [RewardSaleController::class, 'save']);
    Route::get('/get-rewardsales', [RewardSaleController::class, 'getRewardSales']);
    Route::post('/delete-rewardsale', [RewardSaleController::class, 'deleteRewardSale']);

    Route::get('/get-credits', [ReportController::class, 'consolidateCreditReport']);
    Route::post('/get-credits-by-customer', [ReportController::class, 'creditReportByCustomer']);
    Route::post('/get-creditsales-by-customer', [ReportController::class, 'getCreditSalesByInvoice']);

    Route::post('/add-expense-category', [ExpenseCategoryController::class, 'save']);
    Route::get('/get-expense-categories', [ExpenseCategoryController::class, 'getExpenseCategories']);
    Route::post('/delete-expense-category', [ExpenseCategoryController::class, 'deleteExpenseCategory']);

    Route::post('/add-income-category', [IncomeCategoryController::class, 'save']);
    Route::get('/get-income-categories', [IncomeCategoryController::class, 'getIncomeCategories']);
    Route::post('/delete-income-category', [IncomeCategoryController::class, 'deleteIncomeCategory']);


    Route::post('/add-expense', [ExpenseController::class, 'save']);
    Route::get('/get-expenses', [ExpenseController::class, 'getExpenses']);
    Route::get('/get-today-expenses', [ExpenseController::class, 'getTodayExpenses']);
    Route::post('/delete-expense', [ExpenseController::class, 'deleteExpense']);

    Route::post('/add-income', [IncomeController::class, 'save']);
    Route::get('/get-incomes', [IncomeController::class, 'getIncomes']);
    Route::get('/get-today-incomes', [IncomeController::class, 'getTodayIncomes']);
    Route::post('/delete-income', [IncomeController::class, 'deleteIncome']);

    //get-designations
    Route::get('/get-designations', [DesignationController::class, 'getDesignations']);

    Route::post('/add-employee', [EmployeeController::class, 'save']);
    Route::get('/get-employees', [EmployeeController::class, 'getEmployees']);
    Route::post('/delete-employee', [EmployeeController::class, 'deleteEmployee']);

    Route::post('/add-jobcard', [JobcardController::class, 'save']);
    Route::get('/get-jobcards', [JobcardController::class, 'getJobcards']);
    Route::post('/delete-jobcard', [JobcardController::class, 'deleteJobcard']);
    Route::post('/mark_jobcardcompleted',[JobcardController::class, 'mark_jobcardcompleted']);
    Route::post('/mark_jobcarddelivered',[JobcardController::class, 'mark_jobcarddelivered']);

    Route::get('/get-rewards', [ReportController::class, 'consolidateRewardReport']);
    Route::post('/get-rewards-by-customer', [ReportController::class, 'rewardReportByCustomer']);


    Route::post('/get-item-details', [ReportController::class, 'itemReport']);

    Route::post('/get-dashboard', [DashboardController::class, 'report']);


    Route::post('/get-company', [CompanyController::class, 'getCompany']);

    Route::get('/get-profit-report', [ReportController::class, 'profitReport']);

    //Change password
    Route::post('updatePassword', [PasswordChangeController::class, 'changePassword']);
});


Route::get('/',[UserController::class,'index']);
Route::get('/about',[UserController::class,'about']);
Route::get('/services',[UserController::class,'service']);
Route::get('/contact',[UserController::class,'contact']);
