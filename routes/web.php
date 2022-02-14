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
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductAndServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
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
Route::get('/booking', [App\Http\Controllers\BookingController::class, 'booking'])->name('booking');








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
    //category

    Route::post('add-category', [CategoryController::class, 'addCategory']);
    Route::get('get-categories', [CategoryController::class, 'getCategory']);
    Route::post('delete-category', [CategoryController::class, 'deleteCategory']);



    // employee 
    Route::post('add-employee', [EmployeeController::class, 'addEmployee']);
    Route::get('get-employees', [EmployeeController::class, 'getEmployees']);
    Route::post('delete-employee', [EmployeeController::class, 'deleteEmployee']);
    //attendance
    Route::post('add-attendance', [AttendanceController::class, 'addAttendance']);
    Route::get('get-employees-attendance', [AttendanceController::class, 'getEmployeesAttendance']);
    Route::get('get-employees-attendance-report', [AttendanceController::class, 'getEmployeesAttendanceReport']);

    //service
    Route::post('add-service', [ProductAndServiceController::class, 'addService']);
    Route::get('get-service', [ProductAndServiceController::class, 'getService']);
    Route::post('delete-service', [ProductAndServiceController::class, 'deleteService']);
    Route::post('add-to-home', [ProductAndServiceController::class, 'addToHome']);

    //product
    Route::post('add-product', [ProductAndServiceController::class, 'addProduct']);
    Route::get('get-product', [ProductAndServiceController::class, 'getProduct']);
    Route::post('delete-product', [ProductAndServiceController::class, 'deleteProduct']);
    Route::post('remove-from-home', [ProductAndServiceController::class, 'removeFromHome']);

    //customer
    Route::post('add-customer', [CustomerController::class, 'addCustomer']);
    Route::get('get-customers', [CustomerController::class, 'getCustomers']);
    Route::post('delete-customer', [CustomerController::class, 'deleteCustomer']);

    // images
    Route::post('add-image', [ImageController::class, 'addImage']);
    Route::get('get-product-service', [ProductAndServiceController::class, 'getProductAndService']);
    Route::get('get-images', [ImageController::class, 'getImages']);
    Route::post('delete-image', [ImageController::class, 'DeleteImage']);

    // booking admin side 

    Route::get('get-bookings', [BookingController::class, 'getBookings']);
    Route::post('delete-booking', [BookingController::class, 'deleteBooking']);


    // payment

    Route::post('booking-payment', [PaymentController::class, 'addBookingPayment']);
    Route::get('get-payment-report', [PaymentController::class, 'getPaymentReport']);

    // Dashboard 
    Route::get('get-dashboard', [DashboardController::class, 'getDashboard']);
});


Route::get('/', [UserController::class, 'index']);
Route::get('/products', [Singleproductcontroller::class, 'productPage']);
Route::get('/singleproduct/{id}', [Singleproductcontroller::class, 'singleProductPage']);



Route::get('/services', [ServiceController::class, 'servicePage']);

//boooking
Route::post('get-otp', [BookingController::class, 'sendOtp']);
Route::post('new-booking', [BookingController::class, 'addBooking']);
Route::get('get-service', [ProductAndServiceController::class, 'getService']);
Route::get('get-employees', [EmployeeController::class, 'getEmployees']);
