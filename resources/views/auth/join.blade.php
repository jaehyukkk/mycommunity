<!DOCTYPE html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<html lnag="ko">
    <head>
        <meta charset="UTF-8">
        <title>회원가입</title>
        
        <link rel="stylesheet" type="text/css" href="<?php echo asset('css/join.css')?>" >
        <link rel="stylesheet" type="text/css" href="<?php echo asset('css/mypage/find.css')?>" >
        
    </head>
    <body>

        <script src="https://kit.fontawesome.com/db98d81eec.js" 
        crossorigin="anonymous">
        </script>

        <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
                alert(msg);
            }
        </script>

       

        <!-- header -->
        <nav>
            <ul class="logo">
              <li>
                <a href="/">LTL</a>
              </li>
            </ul>
            <ul class="nav-item" style="padding-right: 140px">
              <li>
                <a href="#" style="color:white"><i class="fas fa-user-plus"></i> 회원가입</a>
              </li>
            </ul>
            <ul>
              
            </ul>
          </nav>

          @if (count($errors) > 0)
          <div class="alert-errors">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif


        <!-- wrapper -->
     
        <div id="wrapper">

            <!-- content-->
            <div id="content">
                <form action="/join" method="post">
                    @csrf
                <!-- ID -->
                <div>
                    <h3 class="join_title">
                        <label for="id">아이디</label>
                    </h3>
                    <span class="box int_id">
                        <input type="text" id="id" class="int" maxlength="20" name="userid">
                    </span>
                    <span class="error_next_box"></span>
                </div>

                <!-- PW1 -->
                <div>
                    <h3 class="join_title"><label for="pswd1">비밀번호</label></h3>
                    <span class="box int_pass">
                        <input type="password" id="pswd1" class="int" maxlength="20" name="password">
                        <span id="alertTxt">사용불가</span>
                        <img class="pswdImg" id="pswd1_img1" src="{{URL::asset('/img/m_icon_pass.png')}}">
                    </span>
                    <span class="error_next_box"></span>
                </div>
                
                <!-- PW2 -->
                <div>
                    <h3 class="join_title"><label for="pswd2">비밀번호 재확인</label></h3>
                    <span class="box int_pass_check">
                        <input type="password" id="pswd2" class="int" maxlength="20" name="repassword">
                        <img class="pswdImg" id="pswd2_img1" src="{{URL::asset('/img/m_icon_check_disable.png')}}">
                    </span>
                    <span class="error_next_box"></span>
                </div>

                <!-- NAME -->
                <div>
                    <h3 class="join_title"><label for="name">닉네임</label></h3>
                    <span class="box int_name">
                        <input type="text" id="name" class="int" maxlength="20" name="name">
                    </span>
                    <span class="error_next_box"></span>
                </div>

                <!-- GENDER -->
                <div>
                    <h3 class="join_title"><label for="gender">성별</label></h3>
                    <span class="box gender_code">
                        <select id="gender" class="sel" name="sex">
                            <option>성별</option>
                            <option value="남자">남자</option>
                            <option value="여자">여자</option>
                        </select>                            
                    </span>
                    <span class="error_next_box">필수 정보입니다.</span>
                </div>

                <!-- EMAIL -->
                <div>
                    <h3 class="join_title"><label for="email">이메일</label></h3>
                    <span class="box int_email">
                        <input type="text" id="email" class="int" maxlength="100" placeholder="이메일" name="email">
                    </span>
                    <span class="error_next_box">이메일 주소를 다시 확인해주세요.</span>    
                </div>         
                <!-- JOIN BTN-->
                <center><div class="btn_area">
                    <button type="submit" class="find-result">
                        <span>회원가입</span>
                    </button>
                </div></center>
            </form>
                

            </div> 
            

        </div> 

    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/join.js') }}" defer></script>
    <script  src="https://code.jquery.com/jquery-latest.min.js"></script>
    </body>
</html>