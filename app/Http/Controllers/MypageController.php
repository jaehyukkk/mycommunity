<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Maincategory;
use App\Models\Subcategory;
use App\Models\Noti;
use App\Models\User;
use App\Models\Post;
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
                if($user->social == 1){
                    return view('mypage.chginfor',compact('user'))->with('social','social'); 
                }
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

        $request->validate([
            'name'              => 'required',
            'userid'            => 'required',
            'email'             => 'required',
        ]);

        $vali = $this->chgValidate($userid,$name,$email);
        if($vali != null){
            return redirect()->back()->withErrors($vali);
        }

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

        return redirect('/')->with('alert','회원정보 변경이 완료되었습니다.');
            
    }

    public function chgValidate($userid,$name,$email){

        $message = array();

        if($userid != Auth::user()->userid){
            $checkid = User::where('userid',$userid)->count();
            if($checkid >= 1){
                  array_push($message,'중복된 아이디입니다.');
            }
        }

        if($email != Auth::user()->email){
            $checkEmail = User::where('email',$email)->count();
            if($checkEmail >= 1){
                  array_push($message,'중복된 이메일입니다.');
            }
        }

        if($name != Auth::user()->name){
            $checkName = User::where('name',$name)->count();
            if($checkName >= 1){
                  array_push($message,'중복된 닉네임입니다.');
            }
        }

        return $message;
    }

    public function chgInforCheckId(Request $request){
        $userid = $request->userid;
      
        if($userid == Auth::user()->userid){
            return 0;
        }
        else{
            $count = User::where('userid',$userid)->count();
            return $count;
        }
        
    }

    public function chgInforCheckName(Request $request){

        try{

        $username = $request->username;
        if($username == Auth::user()->name){
            return 0;
        }
        $count = User::where('name',$username)->count();
        return $count;
       

        }
        catch(Exception $e){
            return $e->getMessage();
        }
        
    }

    public function index(){
        $maincategory = Maincategory::all();
        $subcategory = Subcategory::all();

        return view('mypage.index',compact('maincategory','subcategory'));
    }

    public function viewMyPost($name){

        $maincategory = Maincategory::all();
        $subcategory = Subcategory::all();


        $searchResult = Post::join('users', 'posts.user_id', '=', 'users.id')
        ->join('subcategories', 'posts.subcategory_id', '=', 'subcategories.id')
        ->where('posts.writer','=',$name)
        ->select('*','posts.created_at as time','posts.id as idx')
        ->orderBy('posts.id','desc')
        ->paginate(16);
        
        return view('mypage.viewmypost',compact('maincategory','subcategory','searchResult','name'));
    }

}
