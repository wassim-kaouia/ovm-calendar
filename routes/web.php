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
    return view('calendar.showPublicCalendar');
})->name('calendrier-index')->middleware('auth');

Route::get('/assistantCalendar', function () {
    return view('calendar.calendar-assistant');
})->name('calendrier-assistant')->middleware(['auth','isAssistant']);

Route::get('/webmasterCalendar', function () {
    return view('calendar.calendar-webmaster');
})->name('calendrier-webmaster')->middleware(['auth','isWebmaster']);

Route::get('/supervisorCalendar', function () {
    return view('calendar.calendar-supervisor');
})->name('calendrier-supervisor')->middleware(['auth','isSupervisor']);

Route::get('/vendorCalendar', function () {
    return view('calendar.calendar-vendor');
})->name('calendrier-vendor')->middleware(['auth','isVendor']);


Route::get('/getavatar',function(){
    return asset('avatar/default/avatar.png');
});

Route::get('/full-calendar',[EventController::class,'index'])->name('full.calendar')->middleware('auth');
Route::get('/full-calendar-assistant',[EventController::class,'indexAssistant'])->name('full.calendar.assistant')->middleware('auth');
Route::get('/full-calendar-webmaster',[EventController::class,'indexWebmaster'])->name('full.calendar.webmaster')->middleware('auth');
Route::get('/full-calendar-supervisor',[EventController::class,'indexSupervisor'])->name('full.calendar.supervisor')->middleware('auth');
Route::get('/full-calendar-vendor',[EventController::class,'indexVendor'])->name('full.calendar.vendor')->middleware('auth');


Route::post('/event/create',[EventController::class,'eventCreate'])->name('event-post')->middleware('auth');
Route::put('/event/update',[EventController::class,'eventUpdate'])->name('event-update')->middleware('auth');
Route::delete('event/delete',[EventController::class,'eventDelete'])->name('event-delete')->middleware('auth');
Route::get('/getEventById/{id}',[EventController::class,'getEventById'])->name('get.event')->middleware('auth');
Route::get('/getAssignedToName/{id}',[EventController::class,'getAssignedToName'])->name('get.assignedto')->middleware('auth');
Route::get('/checkVendorUpdatability/{id}',[EventController::class,'checkVendorUpdatability'])->name('get-vendor-access-to-update');

Route::get('/users',[UserController::class,'index'])->name('users-list')->middleware(['auth','isAdmin']);
Route::get('/userEditPage/{id}',[UserController::class,'edit'])->name('users-edit')->middleware('auth');
Route::put('/userUpdate',[UserController::class,'update'])->name('users-update')->middleware('auth');
Route::get('/getUsersList',[UserController::class,'getUsersList'])->name('get-users')->middleware('auth');
Route::get('/user/profile/{id}',[UserController::class,'getProfile'])->name('get-profile')->middleware('auth');
Route::post('/user/updateProfile',[UserController::class,'updateProfile'])->name('update-profile')->middleware('auth');
Route::get('/user/add/page',[UserController::class,'getAddPage'])->name('get-add-page')->middleware(['auth','isAdmin']);
Route::post('/user/add/',[UserController::class,'addNewUser'])->name('post-new-user')->middleware('auth');
Route::delete('/user/delete/{id}',[UserController::class,'destroyUser'])->name('user-delete')->middleware('auth');

Route::get('/logs',[LogController::class,'index'])->name('logs.index')->middleware('auth');
Route::get('/detailsLogs/{id}',[LogController::class,'show'])->name('logs.show')->middleware('auth');

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
