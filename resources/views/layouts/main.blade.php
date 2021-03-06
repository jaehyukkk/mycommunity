<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="gA5M1ePu_QT6eOyWMrre8cSrYYf8SW6_cyvgmPl_IA4" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->

    @yield('css')

    <title>LTL</title>
  </head>
  <body>
<div class="main-wrap">
  <section>
    @yield('script')

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
    <a href="/"><img src="{{URL::asset('/img/logo1.png')}}" id=""alt="..."></a>
  </div>
</div>

<nav role="navigation" id="navigation"class="navigation">

  <ul id="main-menu" class="main-menu-board">
    <li><a href="/viewall">최신글목록</a></li>
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
    <li><a href="#">건의사항</a></li>
    <li><a href="https://r2beat-ko.valofe.com/main" target="_black">알투비트</a></li>
  </ul>

</nav>


<input class="burger-check" type="checkbox" id="burger-check" /><label class="burger-icon" for="burger-check"><span class="burger-sticks"></span></label>
<div class="mobile-nav-menu">
  <div style="width: 320px;">
  <ul>
    <div class="mobile-menu-title">
      <div><i class="far fa-address-card"></i> 내정보</div>
    </div>
    <div class="mobile-menu-list">
      @guest
        <li class="mobile-menu-maincategory"><a href="/mobile/login">로그인</a></li> 
        <li class="mobile-menu-maincategory"><a href="/mobile/join">회원가입</a></li>  
      @endguest
      @auth
        <li class="mobile-menu-maincategory"><a href="/logout">로그아웃</a></li>
        <li class="mobile-menu-maincategory"><a href="/mobile/chginfo/{{ Auth::user()->id }}">내정보변경</a></li>
        <li class="mobile-menu-maincategory"><a href="/viewmypost/{{ Auth::user()->name }}">내가쓴글</a></li>
      @endauth
      
    </div>
      <div class="mobile-menu-title">
        <div><i class="fas fa-chalkboard-teacher"></i> 리스트</div>
      </div>
      @foreach ($maincategory as $mains )
      <div class="mobile-menu-list">
      <li class="mobile-menu-maincategory"><a href="#" style="font-size:16px; color:rgb(202, 202, 202)">{{ $mains->maincategoryname }}</a></li>
        @foreach ($subcategory as $subs )
          @if($subs->maincategory_id == $mains->id)
          <li class="mobile-menu-maincategory"><a href="/board/{{ $mains->id }}/{{ $subs->id }}">{{ $subs->subcategoryname }}</a></li>
          @endif
        @endforeach
      </div>
      @endforeach
  </ul>
  </div>
</div>



@yield('error')


<article id="main">
  
    @yield('content')
    @yield('loginbox')
  
</article>
@yield('subContent')
</section>
<footer id="foot">
  <div id="foot-content">
    <div>
      <i class="far fa-envelope"></i> Email : ltl20211024@gmail.com
    </div>
    <div>
      Copyright &copy; 2021 www.lblouge.com
    </div>
  </div>
</footer>

</div>
</body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 
  
</html>