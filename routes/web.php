<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MailSendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminCategoryController;
use App\Models\Maincategory;
use App\Models\Subcategory;
use App\Models\Post;
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

    $board = DB::table('posts')
    ->leftJoin('users', 'posts.user_id', '=', 'users.id')
    ->select('*','posts.created_at as time','posts.id as idx')
    ->orderBy('posts.id','desc')
    ->get();

    return view('welcome', compact('maincategory','subcategory','board'));
})->name('main');

Route::get('/mailSend',[MailSendController::class,'mailSend'])->name('mailSend');
Route::post('/mailSendSubmit',[MailSendController::class,'mailSendSubmit'])->name('mailSendSubmit');

//아이디찾기
Route::post('/findIdSubmit',[MailSendController::class,'findIdSubmit']);
Route::post('/findPwSubmit',[MailSendController::class,'findPwSubmit']);
Route::post('/findPwChgSubmit',[MailSendController::class,'findPwChgSubmit']);

Route::get('/findid',[MailSendController::class,'findId']);
Route::get('/findpw',[MailSendController::class,'findPw']);
Route::post('/findPwchg',[MailSendController::class,'findPwchg']);

Route::get('/findPwchg', function(){
    return redirect()->back();
});


Route::post('/board/store',[PostController::class,'store']);
Route::get('/board/{id}',[PostController::class,'index']);
Route::get('/board/{id}/{subid}',[PostController::class,'subIndex']);
Route::get('/viewall',[PostController::class,'viewAll']);
Route::get('/read/{id}',[PostController::class,'show']);

//검색
Route::get('/search',[SearchController::class,'getSearchResult']);


Route::get('/mobile/board',[PostController::class,'mobileBoard']);



Route::middleware('auth')->group(function(){

    Route::get('/edit/{idx}',[PostController::class,'edit']);
    Route::post('/update/{id}',[PostController::class,'update']);
    Route::post('/destroy/{id}',[PostController::class,'destroy']);
    Route::get('/board/create/{id}/{subid}',[PostController::class,'create']);

    //마이페이지
    Route::get('/noti/{id}',[MypageController::class,'getNoti']);
    Route::post('/deletenoti',[MypageController::class,'deleteNoti']);
    Route::get('/chginfor/{user}',[MypageController::class,'chgInfor']);
    Route::post('/chginfor',[MypageController::class,'postChgInfor']);

});


Route::middleware('guest')->group(function(){
    Route::get('/join',[UserController::class,'join']);
    Route::post('/join',[UserController::class,'joinProcess']);
    Route::post('/login',[UserController::class,'loginProcess']);
});

Route::post('/joincheckname',[UserController::class,'joinCheckName']);

Route::get('/logout',[UserController::class,'logout']);

Route::post('/commentcreate',[CommentController::class,'create']);
Route::post('/replycreate',[ReplyController::class,'create']);
Route::post('/updatecomment',[CommentController::class,'updataComment']);
Route::post('/updatereply',[ReplyController::class,'updataReply']);
Route::post('/delcomment',[CommentController::class,'delComment']);
Route::post('/delreply',[ReplyController::class,'delReply']);

Route::post('/checkid/chginfor',[UserController::class,'checkIdChgInfor']);
Route::post('/checkname',[UserController::class,'checkName']);






Route::get('/admin',[AdminController::class,'index']);
Route::get('/admin/post',[AdminController::class,'post']);
Route::get('/admin/category',[AdminCategoryController::class,'index']);
Route::get('/admin/users',[AdminController::class,'users']);
Route::get('/admin/comment',[AdminController::class,'comment']);
Route::get('/admin/reply',[AdminController::class,'reply']);

Route::post('/addcategory',[AdminCategoryController::class,'addCategory']);
Route::post('/updatecategory',[AdminCategoryController::class,'updateCategory']);
Route::post('/delcategory',[AdminCategoryController::class,'delCategory']);
Route::post('/deleteuser',[AdminController::class,'deleteUser']);
Route::post('/admin/delete',[AdminController::class,'deleteFunction']);

Route::get('/admin/login',[AdminAuthController::class,'adminLogin']);
Route::post('/admin/login',[AdminAuthController::class,'loginProcess']);
Route::get('/admin/join',[AdminAuthController::class,'viewJoin']);
Route::post('/admin/join',[AdminAuthController::class,'joinProcess']);
Route::get('/admin/logout',[AdminAuthController::class,'logout']);








