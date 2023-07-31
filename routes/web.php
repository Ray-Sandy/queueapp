<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\CustomerServiceController;
use App\Http\Controllers\Login_Controller;

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

Route::get('/login', [Login_Controller::class, 'index'])->name('login');
Route::post('/register', [Login_Controller::class, 'saveregister'])->name('saveregister');
Route::get('/register', [Login_Controller::class, 'register'])->name('register')->middleware('guest');
Route::post('/login',[Login_Controller::class, 'postlogin'])->name('postlogin');
// Route::get('auth/logout', [AuthController::class, 'logout'])->name('postlogout');
Route::post('auth/logout', [Login_Controller::class, 'postlogout'])->name('postlogout');

Route::get('/', [QueueController::class, 'create'])->name('queue.create');
Route::post('/queue', [QueueController::class, 'store'])->name('queue.store');
Route::get('/queue/list/', [QueueController::class, 'index'])->name('queue.index');
Route::delete('/queue/{id}', [QueueController::class, 'destroy'])->name('queue.destroy');
Route::get('/home', [QueueController::class, 'home'])->name('queue.home');

Route::group(['middleware' => ['auth', 'CekLevel:cs,admin']],function () {
    // Place the cs.validateQrCode route before other cs routes
    // Route::post('/validate-queue', [CustomerServiceController::class, 'validateQrCode'])->name('cs.validate-queue');
    Route::get('/cs', [CustomerServiceController::class, 'index'])->name('cs.index');
    Route::put('/cs/call/{id}', [CustomerServiceController::class, 'call'])->name('cs.call');
    Route::put('/cs/skip/{id}', [CustomerServiceController::class, 'skip'])->name('cs.skip');
    Route::put('/cs/complete/{id}', [CustomerServiceController::class, 'complete'])->name('cs.complete');
    // Route::post('/complete-queue', [CustomerServiceController::class, 'completeQueue'])->name('cs.complete-queue');
    Route::post('/cs/updateQueueStatus/{id}', [CustomerServiceController::class, 'updateQueueStatus'])->name('cs.updateQueueStatus');
    Route::post('/cs/complete-queue', [CustomerServiceController::class, 'completeQueue'])->name('cs.complete-queue');
    // Route::post('/validate-queue', [CustomerServiceController::class, 'validateQueue'])->name('cs.validate-queue');
});

Route::get('/queue/waiting/{id}/{counter}', [QueueController::class, 'waiting'])->name('queue.waiting');
Route::get('/queue/get-status', [QueueController::class, 'getStatus'])->name('queue.getStatus');
Route::get('/queue/get-status-id', [QueueController::class, 'getStatusid'])->name('queue.getStatusid');
Route::get('/queue/get-queue-data/{id}/{counter}', [QueueController::class, 'getQueueData'])->name('queue.getQueueData');


