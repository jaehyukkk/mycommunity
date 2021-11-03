<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maincategory;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;
include(app_path().'/includes/simple_html_dom.php');


class MainController extends Controller
{
    public function index(){
    $maincategory = Maincategory::all();
    $subcategory = Subcategory::all();

    $board = DB::table('posts')
    ->leftJoin('users', 'posts.user_id', '=', 'users.id')
    ->select('*','posts.created_at as time','posts.id as idx')
    ->orderBy('posts.id','desc')
    ->get();

        $url = 'https://lovebeat.plaync.com/';
        $rank = file_get_contents($url);

        if($url != false){
            $rank = str_get_html($rank);
        }

    return view('welcome', compact('maincategory','subcategory','board','rank'));
    }
}
