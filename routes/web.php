<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\CustomerServiceController;

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
Route::get('/', [QueueController::class, 'create'])->name('queue.create');
Route::post('/queue', [QueueController::class, 'store'])->name('queue.store');
Route::get('/queue/list/', [QueueController::class, 'index'])->name('queue.index');
Route::delete('/queue/{id}', [QueueController::class, 'destroy'])->name('queue.destroy');
Route::get('/home', [QueueController::class, 'home'])->name('queue.home');

Route::prefix('cs')->group(function () {
    // Place the cs.validateQrCode route before other cs routes
    Route::post('/validateQrCode', [CustomerServiceController::class, 'validateQrCode'])->name('cs.validateQRCode');
    Route::get('/', [CustomerServiceController::class, 'index'])->name('cs.index');
    Route::put('/call/{id}', [CustomerServiceController::class, 'call'])->name('cs.call');
    Route::put('/skip/{id}', [CustomerServiceController::class, 'skip'])->name('cs.skip');
    Route::put('/complete/{id}', [CustomerServiceController::class, 'complete'])->name('cs.complete');
    // Route::post('/complete-queue', [CustomerServiceController::class, 'completeQueue'])->name('cs.complete-queue');
    Route::post('/updateQueueStatus/{id}', [CustomerServiceController::class, 'updateQueueStatus'])->name('cs.updateQueueStatus');
    Route::post('/complete-queue', [CustomerServiceController::class, 'completeQueue'])->name('cs.complete-queue');
    Route::post('/validate-queue', [CustomerServiceController::class, 'validateQueue'])->name('cs.validate-queue');
});

Route::get('/queue/waiting/{id}/{counter}', [QueueController::class, 'waiting'])->name('queue.waiting');
Route::get('/queue/get-status', [QueueController::class, 'getStatus'])->name('queue.getStatus');
Route::get('/queue/get-status-id', [QueueController::class, 'getStatusid'])->name('queue.getStatusid');
Route::get('/queue/get-queue-data/{id}/{counter}', [QueueController::class, 'getQueueData'])->name('queue.getQueueData');


// Route::get('/', [QueueController::class, 'create'])->name('queue.create');
// Route::post('/queue', [QueueController::class, 'store'])->name('queue.store');

// Route::get('/queue/list/{counter}', [QueueController::class, 'listByCounter'])->name('queue.listByCounter');
// Route::delete('/queue/{id}', [QueueController::class, 'destroy'])->name('queue.destroy');
// Route::get('/home', [QueueController::class, 'home'])->name('queue.home');


// Route::prefix('cs')->group(function () {
//     Route::get('/', [CustomerServiceController::class, 'index'])->name('cs.index');
//     Route::put('/call/{id}', [CustomerServiceController::class, 'call'])->name('cs.call');
//     Route::put('/skip/{id}', [CustomerServiceController::class, 'skip'])->name('cs.skip');
//     Route::put('/complete/{id}', [CustomerServiceController::class, 'complete'])->name('cs.complete');
// });

// Route::get('/queue/waiting/{id}/{counter}', [QueueController::class, 'waiting'])->name('queue.waiting');
// Route::get('/queue/get-status', [QueueController::class, 'getStatus'])->name('queue.getStatus');

// Route::middleware(['web'])->group(function () {
//     Route::get('/', [QueueController::class, 'create'])->name('queue.create');
//     Route::post('/queue', [QueueController::class, 'store'])->name('queue.store');
//     Route::get('/queue/waiting/{id}', [QueueController::class, 'waiting'])->name('queue.waiting');
//     // Route::get('/queue/waiting', [QueueController::class, 'waiting'])->name('queue.waiting');
//     Route::get('/queue/list', [QueueController::class, 'index'])->name('queue.index');
//     Route::delete('/queue/{id}', [QueueController::class, 'destroy'])->name('queue.destroy');
//     Route::get('/home', [QueueController::class, 'home'])->name('queue.home');
// });

// Route::group(['prefix' => 'customer-service', 'as' => 'customer-service.'], function () {
//     Route::get('/', [CustomerServiceController::class, 'index'])->name('index');
//     Route::post('/process/{id}', [CustomerServiceController::class, 'process'])->name('process');
// });

// Route::group(['prefix' => 'customer-service', 'as' => 'customer-service.', 'middleware' => 'auth'], function () {
//     // Menambahkan route untuk halaman customer service
// });

// Route::group(['prefix' => 'customer-service', 'as' => 'customer-service.', 'middleware' => 'checkRole:cs'], function () {
//     Route::get('/', 'CustomerServiceController@index')->name('index');
//     Route::get('/process/{id}', 'CustomerServiceController@processQueue')->name('process');
//     Route::get('/skip/{id}', 'CustomerServiceController@skipQueue')->name('skip');
//     Route::get('/complete/{id}', 'CustomerServiceController@completeQueue')->name('complete');
// Route::get('/queue/waiting/{id}', [QueueController::class, 'waiting'])->name('queue.waiting');
// Route::get('/queue/waiting', [QueueController::class, 'waiting'])->name('queue.waiting');
// Route::get('/queue/list', [QueueController::class, 'index'])->name('queue.index');
// });

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', [QueueController::class, 'index'])->name('queue.index');
// Route::post('/queue', [QueueController::class, 'store'])->name('queue.store');
// Route::get('/queue/waiting/{id}', [QueueController::class, 'waiting'])->name('queue.waiting');
// Route::post('/queue/call/{id}', [QueueController::class, 'call'])->name('queue.call');
// Route::post('/queue/complete/{id}', [QueueController::class, 'complete'])->name('queue.complete');

// Route::get('/customer-service', [CustomerServiceController::class, 'index'])->name('customer-service.index');
// Route::post('/customer-service/call-next', [CustomerServiceController::class, 'callNext'])->name('customer-service.call-next');
// Route::put('/customer-service/skip-queue/{queue}', [CustomerServiceController::class, 'skipQueue'])->name('customer-service.skip-queue');

// Route::post('/queue/create', [QueueController::class, 'create'])->name('queue.create');
// Route::get('/waiting', [QueueController::class, 'waiting'])->name('waiting');
// Route::get('/customer-service', [QueueController::class, 'customerService'])->name('customer_service');
// Route::patch('/queue/{queue}/call', [QueueController::class, 'call'])->name('queue.call');
// Route::patch('/queue/{queue}/skip', [QueueController::class, 'skip'])->name('queue.skip');
// Route::patch('/queue/{queue}/complete', [QueueController::class, 'complete'])->name('queue.complete');
// Route::put('/queues/{queue}/call', 'QueueController@call')->name('queues.call');
