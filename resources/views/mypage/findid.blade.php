<!DOCTYPE html>
<html lnag="ko">
    <head>
        <meta charset="UTF-8">
        <title>회원가입</title>
        
        <link rel="stylesheet" type="text/css" href="<?php echo asset('css/join.css')?>" >
        <link rel="stylesheet" type="text/css" href="<?php echo asset('css/mypage/find.css')?>" >
        
    </head>
    <body>
      <script  src="http://code.jquery.com/jquery-latest.min.js"></script>
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

    

        <!-- header -->
  
        <nav>
          <ul class="logo">
            <li>
              <a href="/">LTL</a>
            </li>
          </ul>
          <ul class="nav-item">
            <li>
              <a href="/findid"  style="color:white"><i class="fas fa-search"></i> 아이디 찾기</a>
            </li>
            <li>
              <a href="/findpw"><i class="fas fa-search"></i> 비밀번호 찾기</a>
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
              <p class="find-title">아이디 찾기</p>
        
              <form action="/findIdSubmit" id="findidform" method="post" >
                @csrf
                <!-- ID -->
                <div>
                    <h3 class="join_title">
                        <label for="id">이름</label>
                    </h3>
                    <span class="box int_id">
                        <input type="text" id="id" class="int" maxlength="20" name="name">
                    </span>
                    <span class="error_next_box"></span>
                </div>

                
                <div>
                    <h3 class="join_title"><label for="email">이메일</label></h3>
                    <span class="box int_email">
                        <input type="text" id="email" class="int" maxlength="100" name="email">
                    </span>
                    <span class="error_next_box">이메일 주소를 다시 확인해주세요.</span>    
                </div>         
                <!-- JOIN BTN-->
                <p class="notice">이메일 발송까지 약 2~3초 정도 소요됩니다. </br>알림창이 뜰때까지 잠시만 기다려주세요.</p>
                <center><div class="btn_area">
                    <button type="submit" id="findidformBtn" class="find-result">
                        <span>확인</span>
                    </button>
                </div></center>
            </form>
                

            </div> 
            

        </div> 

    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    </body>
</html>