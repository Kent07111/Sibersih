<?php

use App\Http\Controllers\Admin\ActivityController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\WastePointController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class,'index'])->name('login');

Route::post('/login', [LoginController::class,'login']);

Route::get('/logout', [LoginController::class,'logout']);

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('waste-point', WastePointController::class);
    Route::resource('education',EducationController::class);
    Route::delete(
        'activity-image/{image}',
        [ActivityController::class, 'destroyImage']
    )->name('activity-image.destroy');
    Route::resource('activity',ActivityController::class);
    Route::get(
        'setting/qr-center',
        [SettingController::class,'qrCenter']
    )->name('setting.qr');

    Route::post(
        'setting/generate-qr',
        [SettingController::class,'generateQr']
    )->name('setting.generate.qr');
});
