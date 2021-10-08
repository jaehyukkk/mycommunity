<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/board/board.css') }}" >
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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    {{-- <script  src="http://code.jquery.com/jquery-latest.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" defer></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
    
<script type="text/javascript" src="{{ URL::asset('/js/post.js') }}" defer></script>

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
          <li id="main-menu-board"><a href="/board/{{ $maincategorys->id }}/{{ $subcategorys->id }}" aria-label="subemnu">{{ $subcategorys->subcategoryname }}</a></li>
          @endif
        @endforeach      
      </ul>
    </li>
    @endforeach
  </ul>
</nav>

<article id="main">
<div>
  <div class="board-top">
    <div>
      @foreach ($maincategory as $maincategorys )
      @if($maincategorys->id == $id)
      <h2><a href="/board/{{ $id }}">{{ $maincategorys->maincategoryname }}</a></h2>
      @endif
      @endforeach
    </div>
    <div class="subboard">
      @foreach ($subcategory as $subcategorys)
        @if($subcategorys->maincategory_id == $id)
      <span><a href="/board/{{ $id }}/{{ $subcategorys->id }}">{{ $subcategorys->subcategoryname }}</a></span>
        @endif
      @endforeach
    </div>
  </div>
<table class="table">
  <thead>
    <tr>
      <th scope="col" class="bno"></th>
      <th scope="col">제목</th>
      <th scope="col">작성일</th>
      <th scope="col">작성자</th>
      <th scope="col">조회수</th>
    </tr>
  <tbody>
    @foreach ($notice as $notices )
      @if($notices->notice === 1)
      <tr class="notice">
        <td scope="row" class="noticeText">
          <div>공지</div>
        </td>
        <td class="Title">{{ $notices->title }}</td>
        <td>{{ $notices->time }}</td>
        <td>{{ $notices->name }}</td>
        <td>{{ $notices->hit }}</td>  
      </tr>
      @endif
    @endforeach
    @foreach ($notice as $notices )
      @if($notices->notice === 2)
      <tr class="notice">
        <td scope="row" class="noticeText">
          <div>공지</div>
        </td>
        <td class="Title">{{ $notices->title }}</td>
        <td>{{ $notices->time }}</td>
        <td>{{ $notices->name }}</td>
        <td>{{ $notices->hit }}</td>  
      </tr>
      @endif
    @endforeach
  </tbody>
  </thead>
  <tfoot id="board-content">
    @foreach ($board as $boards )
    <tr>
      <td scope="row" class="bno">{{ $boards->idx }}</td>
      <td class="Title">{{ $boards->title }}</td>
      <td>{{ $boards->time }}</td>
      <td>{{ $boards->name }}</td>
      <td>{{ $boards->hit }}</td>  
    </tr>
    
    @endforeach

  </tfoot>
</table>
<input type="hidden" value="{{ $id }}" id="maincategoryId">
<input type="hidden" value="{{ $subid }}" id="subcategoryId">

<div id="board-foot">
  <div>
  </div>
  <div class="paginateBtn"> 
    {{ $board->links('pagination::custom')}}
  </div>
  <div class="createbtn">
    <a href="/board/create/{{ $id }}/{{ $subid }}">글쓰기</a>
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
   
  </body>
</html>