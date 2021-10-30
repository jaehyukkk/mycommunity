<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css') }}" >
</head>
<body>
    <script  src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://kit.fontawesome.com/db98d81eec.js" 
    crossorigin="anonymous">
    </script>

<div id="mobile-auth">
    
  <center><h1 style="margin-top: 70px">LTL</h1></center>

  <div class="loginForm">
    <div>
        <form action="/login" method="post">
        @csrf
        <span class="box int_id" id="input-id">
        <input type="text" placeholder="아이디" name='userid' class="login-id"><br>
        </span>
        
        <span class="box int_pw" id="input-pw">
        <input type="password" placeholder="비밀번호" name="password"class="login-pw"><br>
        </span>
        
        <center><button type="submit" class="btnLogin">로그인</button></center>
        </form>

        <div class="btnGoogle">
            <a href="{{ route('login.google') }}"><div><i class="fab fa-google-plus-g"></i>GoogleLogin</div></a>
          </div>
        
    </div>
 </div>
  
  </div>
    
</body>
</html>




