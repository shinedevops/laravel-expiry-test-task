<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\RequestController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ManageRequests;
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
    return redirect('login');
});
Route::get('/login', [RequestController::class, 'request_form'])->middleware('guest')->name('frontend-login');
Route::post('send-request',[RequestController::class, 'send_request'])->name('send-request');
Route::get('allow-access/{token}',[RequestController::class, 'login_with_token'])->name('login_with_token');

Route::middleware(['auth','check_user_token'])->group(function () {
    Route::get('/dashboard', [HomeController::class,'index'] )->name('dashboard');
    Route::post('update-details',[HomeController::class,'update_details'])->name('update-details');

    /** Admin tabs **/
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('login-requests',[ManageRequests::class,'index'])->name('login-requests');
        Route::post('accept-request',[ManageRequests::class,'accept_request'])->name('accept-request');
        Route::get('decline-request/{request}',[ManageRequests::class,'decline_request'])->name('decline-request');
    });
});




require __DIR__.'/auth.php';
