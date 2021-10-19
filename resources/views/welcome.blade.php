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

<script  src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/time.js') }}" defer></script>
    
    <script src="https://kit.fontawesome.com/db98d81eec.js" 
    crossorigin="anonymous">
    </script>

<div id="main-logo">
  <div id ="mainTop">
    <a href="/"><h1>LOVEBEAT</br>TALK</br>LOUNGE</h1></a>
  </div>
</div>
<nav role="navigation">

  <ul id="main-menu" class="main-menu-board">
    <li><a href="/viewall">최신글</a></li>
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
    <li><a href="#">건의사항</a></li>
  </ul>

</nav>

<article>
<article id="main">
    <div class="board">
      <div class="main-free-board">
        <div class="main-free-board-top">
          <div>최신글보기</div>
          <span>더보기</span>
        </div>
        <?php $cnt = 0 ;?>
        @foreach ($board as $boards )
        <?php $cnt++ ?>
          @if($cnt == 11)
          <?php break; ?>
          @endif
        <div class="main-free-board-title">
          <div><a href="/read/{{ $boards->idx }}">{{ $boards->title }}</a></div>
          <div>{{ $boards->writer }}</div>
        </div>
        @endforeach
       
      </div>

      <div class="main-free-board">
        <div class="main-free-board-top">
          <div>자유게시판</div>
          <span>더보기</span>
        </div>
        
          <?php $cnt1 = 0?>
          @foreach ($board as $boards )
          @if($boards->maincategory_id == 1 && $boards->subcategory_id == 1)
          <?php $cnt1++?>
          @if($cnt1 == 11)
          <?php break;?>
          @endif
          <div class="main-free-board-title">
          <div>{{ $boards->title }}</div>
          <div>{{ $boards->writer }}</div> 
          </div>       
          @endif
          @endforeach    
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
      <div><img src="{{URL::asset('/image/'.Auth::user()->img)}}" alt=""></div>
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













{{-- 모바일 화면 --}}
<div id="mobile">
<div id="mobile-nav">
  <div><i class="fas fa-chevron-left"></i></div>
  <div>LBL</div>
  <div><i class="fas fa-sign-in-alt"></i></div>
</div>
<div class="mobile-board-box">

@foreach ($board as $boards )

  <div class="mobile-board">
    <div class="mobile-board-item">
      <div><a href="/read/{{ $boards->idx }}">{{ $boards->title }}</a></div>
      <div><span>{{ $boards->name }}</span><span class="time">{{ $boards->time }}</span><span>조회{{ $boards->hit }}</span></div>
      <div>자유게시판</div>
    </div>
    <div>
     <div class="mobile-board-commnet">{{ $boards->commentnum }}</div>  
    </div>
  </div> 

  @endforeach

</div>


<div id="footer">
  <div class="mobile-footer-item">
    <span><i class="far fa-address-card"></i></span>
    <span><i class="fas fa-search"></i></span>
    <span><a href="/mobile/board"><i class="fas fa-bars"></i></a></span>
  </div>
</div>

</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>