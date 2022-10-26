<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
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
})->name('calendrier-index')->middleware('auth');

Route::get('/full-calendar',[EventController::class,'index'])->name('full.calendar')->middleware('auth');
Route::post('/event/create',[EventController::class,'eventCreate'])->name('event-post')->middleware('auth');
Route::put('/event/update',[EventController::class,'eventUpdate'])->name('event-update')->middleware('auth');
Route::delete('event/delete',[EventController::class,'eventDelete'])->name('event-delete')->middleware('auth');
Route::get('/getEventById/{id}',[EventController::class,'getEventById'])->name('get.event')->middleware('auth');


Route::get('/users',[UserController::class,'index'])->name('users-list')->middleware('auth');
Route::get('/userEditPage/{id}',[UserController::class,'edit'])->name('users-edit')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

