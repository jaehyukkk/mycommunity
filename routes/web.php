<?php

use App\Http\Controllers\PostController;
use App\Models\Maincategory;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {

    $maincategory = Maincategory::all();
    $subcategory = Subcategory::all();

    return view('welcome', compact('maincategory','subcategory'));
});

Route::get('/mailSend',[MailSendController::class,'mailSend'])->name('mailSend');
Route::get('/mailSendSubmit',[MailSendController::class,'mailSend'])->name('mailSendSubmit');

Route::get('board',[PostController::class,'index']);
Route::get('imageupload',[PostController::class,'imageupload']);
Route::post('/board/store',[PostController::class,'store']);



