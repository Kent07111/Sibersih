<?php

use App\Http\Controllers\Admin\ActivityController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\WastePointController;
use App\Http\Controllers\Guest\ActivitygController;
use App\Http\Controllers\Guest\EducationqController;
use App\Http\Controllers\Guest\GallerygController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\ReportgController;
use App\Http\Controllers\Guest\SchedulegController;

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

Route::get('/',[HomeController::class,'index'])->name('guest.home');
Route::prefix('edukasi')->name('guest.education.')->group(function () {
        Route::get('/',[EducationqController::class,'index'])->name('index');
        Route::get('/{education:slug}',[EducationqController::class,'show'])->name('show');
    });
Route::prefix('kegiatan')->name('guest.activity.')->group(function () {
        Route::get('/',[ActivitygController::class,'index'])->name('index');
        Route::get('/{activity:slug}',[ActivitygController::class,'show'])->name('show');
    });
Route::prefix('galeri')->name('guest.gallery.')->group(function () {
        Route::get('/',[GallerygController::class,'index'])->name('index');
    });
Route::prefix('jadwal')
    ->name('guest.schedule.')
    ->group(function () {

        Route::get(
            '/',
            [SchedulegController::class,'index']
        )->name('index');

    });
Route::prefix('lapor')
    ->name('guest.report.')
    ->group(function () {

        Route::get(
            '/',
            [ReportgController::class,'create']
        )->name('create');

        Route::post(
            '/',
            [ReportgController::class,'store']
        )->name('store');

        Route::get(
            '/berhasil',
            [ReportgController::class,'success']
        )->name('success');

    });
/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/admin/education/upload-image',[App\Http\Controllers\Admin\EducationController::class, 'uploadImage'])->name('education.upload-image');
    Route::resource('waste-point', WastePointController::class);
    Route::resource('education',EducationController::class);
    Route::delete('activity-image/{image}',[ActivityController::class, 'destroyImage'])->name('activity-image.destroy');
    Route::resource('activity',ActivityController::class);
    Route::get('/setting/qr-center',[SettingController::class,'qrCenter'])->name('setting.qr-center');
    Route::post('/setting/qr-center',[SettingController::class,'generateQr'])->name('setting.generate-qr');
    Route::resource('report',ReportController::class)->only(['index','show','update','destroy']);
    Route::resource('gallery', GalleryController::class)->only(['index','show']);
    Route::resource('schedule',ScheduleController::class);
    Route::resource('settings',SettingController::class)->only(['index','store','update']);
});