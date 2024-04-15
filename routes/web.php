<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\FilmController;
use App\Http\Controllers\Client\AuthController;

Route::middleware('admin')->prefix('admin')->group(function () {

    Route::controller(App\Http\Controllers\Admin\HomeController::class)->group(function () {
        Route::any('/', 'Index')->name('admin.home');
    });

    Route::controller(App\Http\Controllers\Admin\FilmController::class)->group(function () {
        Route::any('/phim', 'video')->name('admin.video');
        Route::any('/phim/upload', 'upload')->name('admin.upload');
        Route::any('/danh-sach-phat', 'danh_sach_phim')->name('admin.danh_sach_phim');
        Route::any('/{idFilm}/edit-album', 'edit_danh_sach_phim');
        Route::any('/{idVideo}/edit-video', 'edit_video');
        Route::any('/part/{idFilm}', 'phan_phim');
        Route::any('/part/{idFilm}/{idPart}/edit-part', 'edit_phan_phim');
    });
});

Route::controller(HomeController::class)->group(function () {
    Route::any('/', 'Index');
    Route::any('/search', 'Search')->name('search');
});

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::any('/login', 'Login');
    Route::any('/register', 'Register');
});
Route::middleware('auth')->controller(HomeController::class)->group(function () {
    Route::any('/account', 'account');
});



Route::any('/logout', [AuthController::class,'Logout']);

Route::controller(FilmController::class)->group(function () {
    Route::any('/phim/{slug}', 'Index');
    Route::any('/phim/{slug}/{phan}/{tap}.html', 'Index');
});