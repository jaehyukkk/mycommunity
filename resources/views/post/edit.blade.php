<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/summernote/summernote-lite.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/summernote/css.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/board/board.css') }}" >
    
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> --}}
</head>
<body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    {{-- <script  src="http://code.jquery.com/jquery-latest.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" defer></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
    


    <script type="text/javascript" src="{{ URL::asset('/summernote/summernote-lite.js') }}" defer></script>
    <script type="text/javascript" src="{{ URL::asset('/summernote/js.js') }}" defer></script>
    <script type="text/javascript" src="{{ URL::asset('/summernote/lang/summernote-ko-KR.js') }}" defer></script>
    <script type="text/javascript" src="{{ URL::asset('/js/post.js') }}" defer></script>

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
<article id="create-main">
    @foreach ($post as $posts ) 
    <form action="/update/{{ $posts->id }}" method="post">
         @csrf
        <div class="container" id="create-container">
            <div id="container-title" data-id ={{ $subid }}></div>
            <span class="box title" id="create-title">    
                 
                <input type="text" placeholder="제목을 입력하세요." name="title"class="create-title"
                value="{{ $posts->title }}"
                ><br>
             </span>
            <textarea id="summernote" name="description">{{ $posts->description }}</textarea>  
            @endforeach
            <input type="hidden" name="caid" value="{{ $id }}">
            <input type="hidden" name="subid" value="{{ $subid }}">
            <div id="create-option">
                <div>
                    <span>공지설정</span>
                    <select name="notice">
                        <option value="0">선택안함</option>
                        <option value="1">전체공지</option>
                        <option value="2">게시판공지</option>
                    </select>
                </div>
                <div>
                    <input type="submit" value="등록">
                </div>
            </div>
            
            
        </div>
        
    </form>

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


</body>
</html>