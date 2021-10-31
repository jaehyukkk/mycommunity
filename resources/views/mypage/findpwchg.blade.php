<!DOCTYPE html>
<html lnag="ko">
    <head>
        <meta charset="UTF-8">
        <title>회원가입</title>
        
        <link rel="stylesheet" type="text/css" href="<?php echo asset('css/join.css')?>" >
        <link rel="stylesheet" type="text/css" href="<?php echo asset('css/mypage/find.css')?>" >
        
    </head>
    <body>
      <script  src="https://code.jquery.com/jquery-latest.min.js"></script>
      <script type="text/javascript" src="{{ URL::asset('js/mypage.js') }}" defer></script>
        <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if(exist){
                alert(msg);
            }
        </script>
           <script src="https://kit.fontawesome.com/db98d81eec.js" 
           crossorigin="anonymous">
           </script>

        @if (count($errors) > 0)
        <div class="alert-errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- header -->
  
        <nav>
          <ul class="logo">
            <li>
              <a href="/">LTL</a>
            </li>
          </ul>
          <ul class="nav-item">
            <li>
              <a href="/findid"><i class="fas fa-search"></i> 아이디 찾기</a>
            </li>
            <li>
              <a href="/findpw" style="color:white"><i class="fas fa-search"></i> 비밀번호 찾기</a>
            </li>
          </ul>
          <ul>
            
          </ul>
        </nav>
        
        <!-- wrapper -->
     
        <div id="wrapper">

            <!-- content-->
            <div id="content">
              <p class="find-title">비밀번호 변경</p>
        
              <form action="/findPwChgSubmit" id="findpwform" method="post" >
                @csrf
                <!-- ID -->
                <div>
                    <h3 class="join_title">
                        <label for="id">비밀번호</label>
                    </h3>
                    <span class="box int_id">
                        <input type="password" id="password" class="int" maxlength="20" name="password">
                    </span>
                    <span class="error_next_box"></span>
                </div>

                
                <div>
                    <h3 class="join_title"><label for="email">비밀번호 확인</label></h3>
                    <span class="box int_email">
                        <input type="password" id="repassword" class="int" maxlength="100" name="repassword">
                    </span> 
                </div>         
                <!-- JOIN BTN-->
                <center><div class="btn_area">
                    <button type="submit" class="find-result" id="pwchgBtn">
                        <span>확인</span>
                    </button>
                </div></center>
            </form>
                

            </div> 
        </div> 

    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    </body>
</html>