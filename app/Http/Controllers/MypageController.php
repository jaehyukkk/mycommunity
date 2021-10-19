<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Maincategory;
use App\Models\Subcategory;
use App\Models\Noti;
use App\Models\User;
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


    public function chgInfor(User $user){
    
            if($user->id == Auth::user()->id){
                return view('mypage.chginfor',compact('user'));
            }
            else{
                return redirect('/')->with('alert','잘못된 접근입니다.');
            }
        
    }

    public function postChgInfor(Request $request){
        $userid = $request->userid;
        $name = $request->name;
        $email = $request->email;

        if($request->hasfile('profileimg')){
               
            $photo = $request->file('profileimg');
            $filename = time().rand(1,9999).'.'.$photo->extension();
            $photo->move(public_path('image'),$filename);
            $files = $filename;
            
            User::where('id',Auth::user()->id)->update([
                'userid' => $userid,
                'name' => $name,
                'email' => $email,
                'img' => $files
            ]);
        }
        else{
            User::where('id',Auth::user()->id)->update([
                'userid' => $userid,
                'name' => $name,
                'email' => $email,
            ]);
        }
            
    }

}
