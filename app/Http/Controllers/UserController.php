<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

use Exception;

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



    public function joinCheckName(Request $request){

        try{

        $username = $request->username;
    
        $count = User::where('name',$username)->count();
        return $count;
       

        }
        catch(Exception $e){
            return $e->getMessage();
        }
        
    }

    public function joinCheckEmail(Request $request){
        $email = $request->email;

        $count = User::where('email',$email)->count();
        return $count;
    }


 



    public function joinProcess(Request $request){

        $request->validate([
            'name'              => 'required|unique:users',
            'userid'            => 'required|unique:users',
            'password'          => 'min:8|required_with:repassword|same:repassword',
            'repassword'        => 'min:8',
            'email'             => 'required|unique:users',
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
            // 'sex'               => $data['sex'],
            'email'             => $data['email'],
            'img'               => 'img.jpg'
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
        Auth::logout();
        return redirect('/')->with('alert','로그아웃 되었습니다.');
    } 
    
    //구글 로그인
    
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }


    public function handleGoogleCallback()
    {
        $userSocial = Socialite::driver('google')->stateless()->user();
        $users = User::Where(['userid' => $userSocial->getId() ])->first();
        $name = rand(0,999).$userSocial->getName(); //구글 이름으로 회원가입 될 시에 중복방지
        try{
            if($users){
                Auth::login($users);
                return redirect('/');
            }
            else{
    
                $users = User::create([
                    'userid'       => $userSocial->getId(),
                    'email'        => $userSocial->getEmail(),
                    'name'         => $name,
                    'password'     => Hash::make(uniqid()),
                    'social'       => 1,
                    'img'          => 'img.jpg'
                ]);
    
                $users = User::Where(['userid' => $userSocial->getId() ])->first();
    
                Auth::login($users);
                return redirect('/')->with('alert','중복방지 닉네임이 설정되었습니다. \n내 정보 변경탭을 눌러 닉네임을 변경해주세요.');
            }
        }
        catch(Exception $e){
            return redirect()->back()->with('alert','다시 시도해주세요.');
        }
       

    }

    public function randName(){

        $inArray = array("김", "이", "박", "최", "정", "강", "조", 
        "윤", "장", "임", "한", "오", "서", "신", "권", "황", "안", 
        "송", "류", "전", "홍", "고", "문", "양", "손", "배", "조", 
        "백", "허", "유", "남", "심", "노", "정", "하", "곽", "성", 
        "차", "주","우", "구", "신", "임", "나", "전", "민", "유", 
        "진", "지", "엄", "채", "원", "천", "방", "공", "강", "현", 
        "함", "변", "염", "양","변", "여", "추", "노", "도", "소", 
        "신", "석", "선", "설", "마", "길", "주", "연", "방", "위", 
        "표", "명", "기", "반", "왕", "금","옥", "육", "인", "맹", 
        "제", "모", "장", "남", "탁", "국", "여", "진", "어", "은", 
        "편", "구", "용");

        $outArray = array_rand($inArray, 2);
        
        $inArray2 = array("가", "강", "건", "경", "고", "관", "광", 
        "구", "규", "근", "기", "길", "나", "남", "노", "누", "다",
        "단", "달", "담", "대", "덕", "도", "동", "두", "라", "래", 
        "로", "루", "리", "마", "만", "명", "무", "문", "미", "민", 
        "바", "박", "백", "범", "별", "병", "보", "빛", "사", "산", 
        "상", "새", "서", "석", "선", "설", "섭", "성", "세", "소", 
        "솔", "수", "숙", "순", "숭", "슬", "승", "시", "신", "아", 
        "안", "애", "엄", "여", "연", "영", "예", "오", "옥", "완", 
        "요", "용", "우", "원", "월", "위","유", "윤", "율", "으", 
        "은", "의", "이", "익", "인", "일", "잎", "자", "잔", "장", 
        "재", "전", "정", "제", "조", "종", "주", "준", "중", "지", 
        "진", "찬", "창", "채", "천", "철", "초", "춘", "충", "치", 
        "탐", "태", "택", "판", "하", "한", "해", "혁", "현", "형",
        "혜", "호", "홍", "화", "환", "회", "효", "훈", "휘", "희",
         "운", "모", "배", "부", "림", "봉", "혼", "황", "량", "린",
         "을", "비","솜", "공", "면", "탁", "온", "디", "항", "후", 
         "려", "균", "묵", "송", "욱", "휴", "언", "령", "섬", "들", 
         "견", "추", "걸", "삼","열", "웅", "분", "변", "양", "출", 
         "타", "흥", "겸", "곤", "번", "식", "란", "더", "손", "술", 
         "훔", "반", "빈", "실", "직", "흠","흔", "악", "람", "뜸", 
         "권", "복", "심", "헌", "엽", "학", "개", "롱", "평", 
         "늘", "늬", "랑", "얀", "향", "울", "련");

         $outArray2 = array_rand($inArray2, 2);

    
         $firstName =  $inArray[$outArray[0]];
         $middleName =  $inArray2[$outArray2[0]];
         $lastName = $inArray2[$outArray2[1]];

         return rand(0,999).$firstName.$middleName.$lastName;
        


    }


}
