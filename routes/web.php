<?php

use App\Http\Controllers\EventController;
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

// Route::get('/', function () {
//     return view('calendar.index');
// });

Route::get('/', function () {
    return view('calendar.showPublicCalendar');
});

Route::get('/full-calendar',[EventController::class,'index'])->name('full.calendar');
Route::post('/event/create',[EventController::class,'eventCreate'])->name('event-post');
Route::PUT('/event/update',[EventController::class,'eventUpdate'])->name('event-update');
Route::get('/getEventById/{id}',[EventController::class,'getEventById'])->name('get.event');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
