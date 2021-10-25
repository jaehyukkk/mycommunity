<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Maincategory;
use App\Models\Subcategory;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\Promise\all;

class MailSendController extends Controller
{
    //테스트-----------
    public function mailSend(Request $request) { 
        return view('mailSend'); 
    }

    public function mailSendSubmit(Request $request){ 
        $data_arr = array(
             'subject' => $request->subject, 
             'name' => $request->name, 
             'emailAddr' => $request->emailAddr, 
             'content' => $request->content 
            ); 
             Mail::send('mail.mail_form', ['data_arr' => $data_arr], function($message) use ($data_arr){ 
                 $message->to('wogur1178@naver.com')->subject($data_arr['subject']); 
                 $message->from($data_arr['emailAddr']); 
                }); 
                return $request;
                
            }
    //-----------테스트


            //아이디 찾기 페이지
            public function findId(){
                $maincategory = Maincategory::all();
                $subcategory = Subcategory::all();
                return view('mypage.findid', compact('maincategory','subcategory'));    
            }

            //비밀번호 찾기 페이지
            public function findPw(){
                return view('mypage.findpw');
            }


            //이메일과 이름을 입력받아서 그에맞는 아이디가 있는지 확인 후
            //있으면 메일센드를 이용해 해당 이메일로 아이디 전송
            public function findIdSubmit(Request $request){ 
                $email = $request->email;
                $name = $request->name;

                $id = User::where('email',$email)->where('name',$name)->first();
                
                try{
                $data_arr = array(
                     'subject' => 'LTL 아이디입니다.', 
                     'content' => $id->userid,
                     'email'   => $request->email,
                     'emailAddr' => 'ltl@naver.com' 
                    ); 
                    
                    //메일센드 폼으로 데이터바인딩
                     Mail::send('mail.mail_form', ['data_arr' => $data_arr], function($message) use ($data_arr){ 
                         $message->to($data_arr['email'])->subject($data_arr['subject']); 
                         $message->from($data_arr['emailAddr']); 
                        }); 

                        return 1;
             
                }catch(Exception $e){
                    return $e->getMessage();
                }
               
            }


            //이메일과 아이디를 받아서 그에맞는 아이디가 있으면
            //해당 이메일로 랜덤 24자릿수 인증번호를 전송 후
            //나중에 인증확인을 위한 인증번호와 ID 를 세션에 저장

            public function findPwSubmit(Request $request){ 
                $email = $request->email;
                $userid = $request->userid;

                $id = User::where('email',$email)->where('userid',$userid)->first();
                $random =  bin2hex(random_bytes(24));

                try{
                if($id){
                $data_arr = array(
                     'subject' => 'LTL 비밀번호 변경 코드입니다.', 
                     'content' => $random,
                     'email'   => $request->email,
                     'emailAddr' => 'ltl@naver.com' 
                    ); 
                    
                   session()->put('code',$random);
                   session()->put('userid',$userid);

                     Mail::send('mail.mail_pw_form', ['data_arr' => $data_arr], function($message) use ($data_arr){ 
                         $message->to($data_arr['email'])->subject($data_arr['subject']); 
                         $message->from($data_arr['emailAddr']); 
                        }); 
                        return 1;
                    }
                    else{
                        return 2;
                    }
                }catch(Exception $e){
                    return $e->getMessage();
                    
                }
               
            }


            //유저가 인증번호를 입력하면
            //세션에 저장해두었던 인증번호와 일치하는지 확인 후
            //일치 하면 비밀번호 변경 창으로 이동
            public function findPwchg(Request $request){
                try{
                if(session()->has('code')){

                $sessionCode =  session()->get('code');
                $code = $request->code;
                    if($sessionCode == $code){
                        return view('mypage.findpwchg');
                    }
                    else{
                        return redirect()->back()->with('alert','인증번호가 잘못되었습니다.');
                    }
                }
                else{
                    return redirect()->back()->with('alert','인증번호가 만료되었습니다.');
                }
            }catch(Exception $e){
               return 'asdasd';
            }
               
            }
            
            //비밀번호 변경 후 세션 삭제
            public function findPwChgSubmit(Request $request){

                $password = $request->password;
                if(session()->has('userid')){
                User::where('userid', session()->get('userid'))->update([
                    'password' => Hash::make($password),
                ]);
                session()->forget('userid');
                session()->forget('code');

                return redirect('/');
                }
                else{
                    return redirect()->back()->with('alert','인증번호가 만료되었습니다.');
                }
            }

    
}
