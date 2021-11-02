<?php

namespace App\Http\Controllers;

use App\Models\Maincategory;
use App\Models\Subcategory;
use App\Models\Post;
use App\Functions\SearchClass;
use App\Functions\UserPostSearch;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getSearchResult(Request $request){

        $maincategory = Maincategory::all();
        $subcategory = Subcategory::all();

        $value = $request->category;
        $search = $request->search;
        $id = $request->id;
        $subid = $request->subid;

        $searchClass = new SearchClass($id,$subid,$value,$search);

        if($id != 0){
            $mainCate = Maincategory::where('id',$id)->first();
            $photocode = $mainCate->photocode;
        }
        else{
            $photocode = 0;
        }
        

        $searchClass->chgTheValue();
        $searchResult = $searchClass->searchResult();

        return view('post.search.index',compact('maincategory','subcategory','searchResult','id','subid','photocode'));
    }

    public function userPostSearchResult($name, Request $request){

        $maincategory = Maincategory::all();
        $subcategory = Subcategory::all();

        $val = $request->category;
        $search = $request->search;

        $userPostSearch = new UserPostSearch($name,$val,$search);

        $userPostSearch->chgTheValue();
        $searchResult = $userPostSearch->searchResult();

        return view('mypage.viewmypost',compact('maincategory','subcategory','searchResult','name'));
    }

  
   
}
