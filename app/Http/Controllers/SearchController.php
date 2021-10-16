<?php

namespace App\Http\Controllers;

use App\Models\Maincategory;
use App\Models\Subcategory;
use App\Functions\SearchClass;
use App\Functions\SubSearchClass;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getSearch(Request $request){

        $maincategory = Maincategory::all();
        $subcategory = Subcategory::all();

        $value = $request->category;
        $search = $request->search;
        $id = $request->id;
        $subid = $request->subid;

        $searchClass = new SearchClass($id,$subid,$value,$search);
        
        $searchClass->chgTheValue();
        $searchResult = $searchClass->searchResult();

        return view('post.search.index',compact('maincategory','subcategory','searchResult','id','subid'));
    }
   
}
