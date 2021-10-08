<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css') }}" >
    <title>Hello, world!</title>
  </head>
  <body>

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

<div id="main-logo">
  <div id ="mainTop">
    <h1>LOVEBEAT</br>TALK</br>LOUNGE</h1>
  </div>
</div>
<nav role="navigation">
  <ul id="main-menu" class="main-menu-board">
    @foreach ($maincategory as $maincategorys )  
    <li><a href="/board/{{ $maincategorys->id }}">{{ $maincategorys->maincategoryname }}</a>
      <ul id="sub-menu">
        @foreach ($subcategory as $subcategorys)
          @if($maincategorys->id === $subcategorys->maincategory_id)
          <li id="main-menu-board"><a href="#" aria-label="subemnu">{{ $subcategorys->subcategoryname }}</a></li>
          @endif
        @endforeach      
      </ul>
    </li>
    @endforeach
  </ul>
</nav>

<article id="main">
    <div class="board">
      <div class="main-free-board">
        <div class="main-free-board-top">
          <div>자유게시판</div>
          <span>더보기</span>
        </div>
        <div class="main-free-board-title">
          <div>제목입니다</div>
          <div>작성자</div>
        </div>
        <div class="main-free-board-title">
          <div>제목입니다</div>
          <div>작성자</div>
        </div>
        <div class="main-free-board-title">
          <div>제목입니다</div>
          <div>작성자</div>
        </div>
        <div class="main-free-board-title">
          <div>제목입니다</div>
          <div>작성자</div>
        </div> 
      </div>

      <div class="main-free-board">
        <div class="main-free-board-top">
          <div>자유게시판</div>
          <span>더보기</span>
        </div>
        <div class="main-free-board-title">
          <div>제목입니다</div>
          <div>작성자</div>
        </div>
        <div class="main-free-board-title">
          <div>제목입니다</div>
          <div>작성자</div>
        </div>
        <div class="main-free-board-title">
          <div>제목입니다</div>
          <div>작성자</div>
        </div>
        <div class="main-free-board-title">
          <div>제목입니다</div>
          <div>작성자</div>
        </div> 
      </div>
    </div>

  <div id="loginBox">
    @if(Auth::guest())
    <div id="loginForm">
      <div id="loginForm-input">
        <form action="/login" method="post">
          @csrf     
        <input type="text" name="userid">
         </br>
        <input type="password" name="password">
      </div>
      <div id="loginForm-submit">
        <button type="submit">로그인</button>
      </form>
      </div>
    </div>
    <div id="loginSubMenu">
      <div>회원가입</div>
      <div>아이디/비밀번호 찾기</div>
    </div>
    <center><div class="loginborder"></div></center>
    <div id="socialLogin">
      <button><i class="fab fa-google-plus-g"></i>GoogleLogin</button>
    </div>
    @else
    <div id="username">
      <div><img src="{{URL::asset('/img/img.JPG')}}" alt=""></div>
      <div><b>{{ Auth::user()->name }}</b></div>
    </div>
    <div id="usermenu">
      <div>
      <div class="usermenu-item">
        <button>내가 쓴 글</button>
        <button>내가 쓴 댓글</button>
      </div>
      <div class="usermenu-item">
        <button>내 활동 알림</button>
        <button>쪽지함</button>
      </div>
      <div id="logout">
        <a href="/logout"><button>로그아웃</button></a>
      </div>
      </div>
    </div>
  
     @endif
     
  </div>
 
    
</article>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>