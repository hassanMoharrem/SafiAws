<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
Route::get('locale/{lang}',[\App\Http\Controllers\LanguageController::class,'switch']);
Route::prefix('admin')->name('api.admin.')->group(function () {
    Route::prefix('users')->name('users.')->group(function () {
        Route::post('/data/users', [\App\Http\Controllers\Admin\UserController::class, 'getAllData'])->name('DataUsers');
        Route::post('/create', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('AddUser');
        Route::post('/{id}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('ShowUser');
        Route::post('/update/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('UpdateUser');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('DeleteUser');
    });
    Route::prefix('stations')->name('stations.')->controller(\App\Http\Controllers\Admin\DessertStationController::class)->group(function(){
        Route::get('/all/{id}','index')->name('data');
        Route::post('/create','store')->name('store');
        Route::post('/delete/{id}','destroy')->name('delete');
    });
    Route::prefix('phases')->name('phases.')->controller(\App\Http\Controllers\Admin\UpdatePhaseController::class)->group(function(){
        Route::get('/all/{id}','index')->name('data');
        Route::post('/create','store')->name('store');
        Route::post('/delete/{id}','destroy')->name('delete');
    });
});
Route::middleware('guest')->name('user.')->group(function () {
    Route::post('/login', [\App\Http\Controllers\User\Auth\AuthController::class, 'login'])->name('login.store');
    Route::post('/social', [\App\Http\Controllers\User\Auth\AuthController::class, 'loginRegister'])->name('login.loginRegister');
    Route::post('/register', [\App\Http\Controllers\User\Auth\AuthController::class, 'register'])->name('register.store');
});

Route::middleware('auth:sanctum')->group( function () {

    Route::prefix('station')->controller(\App\Http\Controllers\User\DessertStationController::class)->group(function(){
        Route::get('/all','index');
        Route::post('/create','store');
        Route::post('/update/{id}','update');
        Route::get('/show/{id}','show');
        Route::get('/search','getSearchStation');
        Route::delete('/delete/{id}','destroy');
    });
    Route::prefix('updatePhase')->controller(\App\Http\Controllers\User\UpdatePhaseController::class)->group(function(){
        Route::get('/all/{id}','index');
        Route::post('/create','store');
        Route::post('/update/{id}','update');
        Route::get('/show/{id}','show');
        Route::delete('/delete/{id}','destroy');
    });
    Route::prefix('profile')->controller(\App\Http\Controllers\User\ProfileController::class)->group(function (){
        Route::get('/show','show');
        Route::post('/update','update');
    });
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/myNotification', [\App\Http\Controllers\User\NotificationController::class, 'index'])->name('DataNotifications');
        Route::get('/myUnreadNotifications', [\App\Http\Controllers\User\NotificationController::class, 'showUnread'])->name('DataUnreadNotifications');
        Route::get('/myReadNotifications', [\App\Http\Controllers\User\NotificationController::class, 'showRead'])->name('DataReadNotifications');
        Route::delete('delete/{id}', [\App\Http\Controllers\User\NotificationController::class, 'destroy'])->name('DeleteNotification');
    });
//    Route::post('/verify', [\App\Http\Controllers\User\Auth\AuthController::class, 'verifyCode'])->withoutMiddleware([\App\Http\Middleware\VerifyUser::class]);
    Route::get('/logout', [\App\Http\Controllers\User\Auth\AuthController::class, 'logout'])->name('logout');

});
