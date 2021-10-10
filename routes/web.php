<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MailSendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReplyController;
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
Route::post('/mailSendSubmit',[MailSendController::class,'mailSendSubmit'])->name('mailSendSubmit');

Route::get('/board/create/{id}/{subid}',[PostController::class,'create']);
Route::post('/board/store',[PostController::class,'store']);
Route::get('/board/{id}',[PostController::class,'index']);
Route::get('/board/{id}/{subid}',[PostController::class,'subIndex']);
Route::get('/read/{id}',[PostController::class,'show']);
Route::get('/edit/{idx}',[PostController::class,'edit']);
Route::post('/update/{id}',[PostController::class,'update']);
Route::post('/destroy/{id}',[PostController::class,'destroy']);

Route::get('/join',[UserController::class,'join']);
Route::post('/join',[UserController::class,'joinProcess']);
Route::post('/login',[UserController::class,'loginProcess']);
Route::get('/logout',[UserController::class,'logout']);

Route::post('/commentcreate',[CommentController::class,'create']);
Route::post('/replycreate',[ReplyController::class,'create']);
Route::post('/updatecomment',[CommentController::class,'updataComment']);
Route::post('/updatereply',[ReplyController::class,'updataReply']);
Route::post('/delcomment',[CommentController::class,'delComment']);
Route::post('/delreply',[ReplyController::class,'delReply']);



