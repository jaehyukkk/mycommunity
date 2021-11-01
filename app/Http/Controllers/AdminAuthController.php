<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('levelcheck');
    }

    public function viewJoin(){
        return view('admin.join'); 
    } 

    public function joinProcess(Request $request){

        $request->validate([
            'name'              => 'required',
            'userid'            => 'required',
            'password'          => 'min:8|required_with:repassword|same:repassword',
            'repassword'        => 'min:8',
        ]);


        $data = $request->all();
        $this->createJoin($data);

        Auth::guard('admin')->attempt([
            'adminid' =>  $request->input('userid'),
            'password' =>  $request->input('password')
        ]);

        if(Auth::guard('admin')->check()){
            return redirect('/')->with('alert','회원가입 완료');
        }

        return redirect()->back()->with('alert','입력이 안된 사항이있거나 형식 오류가있습니다.');  
        
    }

    public function createJoin(array $data){

        return Admin::create([
            'name'              => $data['name'], 
            'adminid'           => $data['userid'],
            'password'          => Hash::make($data['password']),
        ]);      
    }

    public function adminLogin(){
        if(Auth::guard('admin')->check()){
            return redirect('/admin');
        }
        return view('admin.login');
    }

    public function loginProcess(Request $request){

        $request->validate([
            'adminid'        =>'required',
            'password'      =>'required|min:6'
        ]);

        $credentials = $request->only('adminid', 'password');
        
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect('/admin');
        }
        
        return redirect()->back()->with('alert','존재하지 않는 아이디이거나 잘못된 비밀번호입니다.');

    }

    public function logout(){

            Auth::guard('admin')->logout();
            return redirect('/admin/login')->with('alert','로그아웃 되었습니다.');
    }

   

}
