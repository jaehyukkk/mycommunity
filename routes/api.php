<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('imageupload',[PostController::class,'imageuploadProcess']);

//회원가입 아이디중복확인
Route::post('/checkid',[UserController::class,'checkId']);
//글작성시 카테고리 이름 받아오기
Route::get('/getcategorytitle',[PostController::class,'getCategoryTitle']);
Route::get('/getnotice',[PostController::class,'getNotice']);

//댓글관련 라우트
// Route::group(['middleware' => 'auth'], function () {
// Route::post('/commentcreate',[CommentController::class,'create']);
// });

