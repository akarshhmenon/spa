<?php

use App\Http\Controllers\AdminController;

use App\Http\Controllers\PasswordChangeController;
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


Route::group(['prefix' => 'admin', 'middleware' => ['isAdmin', 'auth', 'preventBackHistory']], function () {

    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');


    //Change password
    Route::post('updatePassword', [PasswordChangeController::class, 'changePassword']);
});


Route::get('/',[UserController::class,'index']);
