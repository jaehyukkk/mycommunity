<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserController extends Controller
{
    public function join(){
        return view('auth.join');
    }

    
    public function checkId(Request $request){

        $userid = $request->input('userid');
        $count = User::where('userid',$userid)->count();

        return $count;
    }



    public function joinProcess(Request $request){

        $request->validate([
            'name'              => 'required',
            'userid'            => 'required|unique:users',
            'password'          => 'min:8|required_with:repassword|same:repassword',
            'repassword'        => 'min:8',
            'email'             => 'required',
        ]);


        $data = $request->all();
        $this->createJoin($data);

        Auth::attempt([
            'userid' =>  $request->input('userid'),
            'password' =>  $request->input('password')
        ]);

        if(Auth::check()){
            return redirect('/')->with('alert','회원가입 완료');
        }

        return redirect()->back()->with('alert','입력이 안된 사항이있거나 형식 오류가있습니다.');  
        
    }

    public function createJoin(array $data){

        return User::create([

            'name'              => $data['name'], 
            'userid'            => $data['userid'],
            'password'          => Hash::make($data['password']),
            'sex'               => $data['sex'],
            'email'               => $data['email'],
        ]);      
    }

    public function loginProcess(Request $request){

        $request->validate([
            'userid'        =>'required',
            'password'      =>'required|min:6'
        ]);

        $credentials = $request->only('userid', 'password');
        
        if (Auth::attempt($credentials)) {
            return redirect('/');
        }
        
        return redirect()->back()->with('alert','존재하지 않는 아이디이거나 잘못된 비밀번호입니다.');

    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/')->with('alert','로그아웃 되었습니다.');
    }  

}
