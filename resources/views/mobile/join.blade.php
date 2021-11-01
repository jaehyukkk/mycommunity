<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css?v=').time() }}" >
</head>
<body>

    
    <script  src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/mobilejoin.js?v=').time() }}" defer></script>

    <script src="https://kit.fontawesome.com/db98d81eec.js" 
    crossorigin="anonymous">
    </script>

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    
<div id="mobile-auth">

  

  <div class="loginForm">
    <center><a href="/"><img class="mobile-logo" src="{{URL::asset('/img/logowhite.png')}}" id=""alt="..."></a></center>
    <div>
        <form action="/join" method="post">
        @csrf
        <span class="box int_id" id="input-id">
        <input type="text" placeholder="아이디" name='userid' class="join-id"><br>
        </span>

        <button class="check-btn" id="id-check">아이디 중복검사</button>
    </br>
</br>

        <span class="box int_pw" id="input-pw">
        <input type="password" placeholder="비밀번호" name="password"class="login-pw"><br>
        </span>

        <span class="box int_repw" id="input-pw">
            <input type="password" placeholder="비밀번호확인" name="repassword"class="login-pw"><br>
        </span>

    </br>
</br>

        <span class="box int_name" id="input-pw">
            <input type="text" placeholder="닉네임" name="name"class="join-name"><br>
        </span>
        <button class="check-btn" id="name-check">닉네임 중복검사</button>
    </br>
</br>

        <span class="box int_email" id="input-pw">
            <input type="text" placeholder="이메일" name="email"class="join-email"><br>
        </span>
        <button class="check-btn" id="email-check">이메일 중복검사</button>

    </br>
    </br>
        


        
        <center><button type="submit" class="btnLogin">회원가입</button></center>
        </form>

        
    </div>
 </div>
  
  </div>
    
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



