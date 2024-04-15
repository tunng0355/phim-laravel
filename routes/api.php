<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\FilmController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AdminController::class)->prefix('admin')->group(function () {

    Route::any('/create-album', 'create_album')->name('api.admin.create_album');
    Route::any('/{idFilm}/edit-album', 'edit_album');
    Route::any('/{idFilm}/delete-album', 'delete_album');

    Route::any('/{idFilm}/create-part', 'create_part');
    Route::any('/{idFilm}/{idPart}/delete-part', 'delete_part');
    Route::any('/{idFilm}/{idPart}/edit-part', 'edit_part');

    Route::any('/{idFilm}/list-part', 'list_part');

    Route::post('/add-video', 'add_video')->name('api.admin.add_video');
    Route::any('/{idVideo}/edit-video', 'edit_video')->name('api.admin.edit_video');
    Route::any('/{idVideo}/delete-video', 'delete_video')->name('api.admin.delete_video');

});
Route::controller(FilmController::class)->group(function () {

   Route::post('/{idFilm}/get-video', 'getVideo')->name('api.getVideo');
   Route::get('/check', 'check')->name('api.check');
   Route::post('/{idVideo}/comment', 'sendCmt')->name('api.comment');
   Route::any('/{idVideo}/get-comment', 'getCmt')->name('api.get-comment');

});
