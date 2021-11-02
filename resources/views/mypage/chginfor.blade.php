<!DOCTYPE html>
<meta name="csrf-token" content="{{ csrf_token() }}">
<html lnag="ko">
    <head>
        <meta charset="UTF-8">
        <title>회원가입</title>
        
        <link rel="stylesheet" type="text/css" href="<?php echo asset('css/join.css?v=').time()?>" >
        <link rel="stylesheet" type="text/css" href="<?php echo asset('css/mypage/find.css?v=').time()?>" >
        <link rel="stylesheet" type="text/css" href="<?php echo asset('css/fileinput.css?v=').time()?>" >
        
    </head>
    <body>
        <script  src="https://code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript" src="{{ URL::asset('js/fileinput.js?v=').time() }}" defer></script>

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
            <ul class="nav-item" style="padding-right: 100px">
              <li>
                <a href="#" style="color:white"><i class="fas fa-user-edit"></i> 회원정보 변경</a>
              </li>
            </ul>
            <ul>
              
            </ul>
          </nav>


        <!-- wrapper -->
     
        <div id="wrapper">

            <!-- content-->
            <div id="content">
                <form action="/chginfor" method="post" enctype="multipart/form-data" >
                    @csrf
                <!-- ID -->
                <div>
                    <h3 class="join_title">
                        <label for="id">아이디
                            @if(isset($social))
                            <span style="color:rgb(255, 119, 119); font-size:11px;">소셜로그인 사용자 변경불가능</span>
                            @endif
                        </label>
                    </h3>
                    <span class="box int_id">
                        @if(isset($social))
                        <input type="text" id="id" class="int" maxlength="20" name="userid" value="{{ $user->userid }}" readonly>
                        @else
                        <input type="text" id="id" class="int" maxlength="20" name="userid" value="{{ $user->userid }}">
                        @endif
                    </span>
                    <span class="error_next_box"></span>
                </div>

                <!-- PW1 -->

                <!-- NAME -->
                <div>
                    <h3 class="join_title"><label for="name">닉네임</label></h3>
                    <span class="box int_name">
                        <input type="text" id="name" class="int" maxlength="20" name="name" value="{{ $user->name }}">
                    </span>
                    <span class="error_next_box"></span>
                </div>

                <!-- GENDER -->

                <!-- EMAIL -->
                <div>
                    <h3 class="join_title"><label for="email">이메일</label></h3>
                    <span class="box int_email">
                        <input type="text" id="email" class="int" maxlength="100" placeholder="이메일" name="email" value="{{ $user->email }}">
                    </span>
                    <span class="error_next_box">이메일 주소를 다시 확인해주세요.</span>    
                </div>         

                <div>
                    <h3 class="join_title"><label for="email">프로필 사진</label></h3>

                    <div class="filebox preview-image"> 
                        <input class="upload-name" value="사진선택" disabled="disabled" > 
                        <label for="input-file">업로드</label> 
                        <input type="file" id="input-file" class="upload-hidden" name="profileimg" accept="image/*"> 
                    </div>

                </div>  


                <!-- JOIN BTN-->

                <button type="submit" class="find-result" style="margin-top: 30px;">
                    <span>확인</span>
                </button>
            </form>
                

            </div> 
            

        </div> 

    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/chginfor.js?v=').time()}}" defer></script>
    <script  src="https://code.jquery.com/jquery-latest.min.js"></script>
    </body>
</html>