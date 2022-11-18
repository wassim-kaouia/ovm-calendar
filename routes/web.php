<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\Models\Activity;

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
    // return Activity::all();
    return view('calendar.showPublicCalendar');
})->name('calendrier-index')->middleware('auth');

Route::get('/getavatar',function(){
    return asset('avatar/default/avatar.png');
});

Route::get('/full-calendar',[EventController::class,'index'])->name('full.calendar')->middleware('auth');
Route::post('/event/create',[EventController::class,'eventCreate'])->name('event-post')->middleware('auth');
Route::put('/event/update',[EventController::class,'eventUpdate'])->name('event-update')->middleware('auth');
Route::delete('event/delete',[EventController::class,'eventDelete'])->name('event-delete')->middleware('auth');
Route::get('/getEventById/{id}',[EventController::class,'getEventById'])->name('get.event')->middleware('auth');
Route::get('/getAssignedToName/{id}',[EventController::class,'getAssignedToName'])->name('get.assignedto')->middleware('auth');

Route::get('/users',[UserController::class,'index'])->name('users-list')->middleware('auth');
Route::get('/userEditPage/{id}',[UserController::class,'edit'])->name('users-edit')->middleware('auth');
Route::put('/userUpdate',[UserController::class,'update'])->name('users-update')->middleware('auth');
Route::get('/getUsersList',[UserController::class,'getUsersList'])->name('get-users')->middleware('auth');
Route::get('/user/profile/{id}',[UserController::class,'getProfile'])->name('get-profile')->middleware('auth');
Route::post('/user/updateProfile',[UserController::class,'updateProfile'])->name('update-profile')->middleware('auth');
Route::get('/user/add/page',[UserController::class,'getAddPage'])->name('get-add-page')->middleware('auth');
Route::post('/user/add/',[UserController::class,'addNewUser'])->name('post-new-user')->middleware('auth');

Route::get('/logs',[LogController::class,'index'])->name('logs.index')->middleware('auth');
Route::get('/detailsLogs/{id}',[LogController::class,'show'])->name('logs.show')->middleware('auth');


Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
