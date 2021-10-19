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

    <script  src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/time.js') }}" defer></script>

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




<article id="main">
<div class="table-div">
  <div class="board-top">
    <div>
      <h2><a href="#">검색</a></h2>
    </div>
  </div>

<table class="table">
  <thead>
    <tr>
      <th scope="col" class="bno"></th>
      <th scope="col">제목</th>
      <th scope="col">작성일</th>
      <th scope="col">글쓴이</th>
      <th scope="col">조회수</th>
    </tr>
  </thead>

  @if($photocode != 1)
  <tfoot>
    @foreach ($searchResult as $search )
 
    <tr>
      <td scope="row" class="bno" id="subcategoryname">{{ $search->subcategoryname }}</td>
      <td class="Title"><a href="/read/{{ $search->idx }}">{{ $search->title }} 
        @if($search->code > 0)
        <span class="imgicon"><i class="far fa-image"></i></span>
        @endif

        @if($search->commentnum > 0)
        <span class="commentnum">[{{ $search->commentnum }}]</span>
        @endif
      </a></td>
      <td class="time">{{ $search->time }}</td>
      <td>{{ $search->writer }}</td>
      <td>{{ $search->hit }}</td>  
    </tr>
    @endforeach
  </tfoot>
</table>
@else
</table>
<div id="imgboard">
<div class="container"> 
  <div class="row" >
    @foreach ($searchResult as $search )   
    <div class="col-md-3" id="imgboard-img">
      <a href="/read/{{ $search->idx }}">
      <img class="img" src="{{$search->mainimg}}">
    </a>
      <div id="imgboard-text">
        <div class="imgBoardsubcategory">{{ $search->subcategoryname }}</div>
        <div class="mainimgBoardTitle"><a href="/read/{{ $search->idx }}">{{ $search->title }}</a>
          @if($search->commentnum > 0)
          <span class="commentnum">[{{ $search->commentnum }}]</span>
          @endif
        </div>
        <div class="imgBoardName">{{ $search->writer }}</div>
        <div class="time" id="imgBoardTime">{{ $search->time }}</div>
      </div>
    </div>  
    @endforeach
  </div>
</div>
</div>
@endif

@if(count($searchResult) == 0)
<center class="searchNull"><b>검색 결과가 없습니다.</b></br>
  <span style="font-size: small">정확한 검색어 인지 확인하시고 다시 검색해 주세요.</span>  
  </center>
@endif

<form action="/search">

  <div id="searchBox">
    
      <div class="searchSelect">
        <input type="hidden" name="id" value="{{ $id }}">
        <input type="hidden" name="subid" value="{{ $subid }}">
        <select name="category" id="">
          <option value="1">제목+내용</option>  
          <option value="2">제목</option>  
          <option value="3">내용</option>  
          <option value="4">작성자</option>  
          <option value="5">댓글</option>  
        </select>
      </div>

      <div class="searchInput">
        <span class="inputbox int_search">
          <input type="text" id="search" class="input" maxlength="20" name="search">
        </span>
      </div>
      
      <div class="searchSubmit">
         <input type="submit" value="검색">
      </div>
    </div>
  </form>

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
          <button><a href="/noti/{{ Auth::user()->id }}">내 활동 알림</a></button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>