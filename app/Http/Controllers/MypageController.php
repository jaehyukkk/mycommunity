<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Maincategory;
use App\Models\Subcategory;
use App\Models\Noti;
use Exception;

class MypageController extends Controller
{
    public function getNoti($id){
        if(Auth::check()){
            if(Auth::user()->id == $id){
            $maincategory = Maincategory::all();
            $subcategory = Subcategory::all();

            $noti = Noti::where('user_id',$id)
            ->orderBy('id','desc')
            ->paginate(10);

            return view('mypage.noti',compact('maincategory', 'subcategory', 'noti'));
            }
            else{
                return redirect()->back();
            }
        }
        else{
            return redirect('/');
        }
    }

    public function deleteNoti(Request $request){
        try{

            $delete = $request->input('delete');

            $id = Noti::whereIn('id',$delete)->get('user_id');
            $userId = $id[0]->user_id;

            if(Auth::user()->id == $userId){
                Noti::whereIn('id',$delete)->delete();
                return redirect()->back();
            }
            else{
                return redirect()->back();
            }

        }catch(Exception $e){
            return redirect('/');
        }
  
    }
}
