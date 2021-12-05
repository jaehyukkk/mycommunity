@if(Auth::guest())
<div id="loginBox">
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
    <div><a href="/join">회원가입</a></div>
    <div><a href="/findid">아이디/비밀번호 찾기</a></div>
  </div>
  <center><div class="loginborder"></div></center>
  <div id="socialLogin">
    <a href="{{ route('login.google') }}"><div><i class="fab fa-google-plus-g"></i>GoogleLogin</div></a>
  </div>

@else
<div id="userbox">
  <div id="userlevel">
    @if(Auth::user()->level == 1)
    <div id="admin-menu">
      <div><i class="fas fa-cog"></i> 관리자</div>
      <div><a href="/admin/login">관리자페이지</a></div>
    </div>
    @else
    <div>일반회원</div>
    @endif
  </div>
  <div id="username">
    <div><img src="{{URL::asset('/image/'.Auth::user()->img)}}" alt=""></div>
    <div id="username-item">
      <?php $date =  Auth::user()->created_at; 
      $date = substr($date,0,10);
      ?>
      <div id="username-name">{{ Auth::user()->name }}</div>
      <div id="username-chgimg"><a href="/chginfor/{{ Auth::user()->id }}" style="color:gray"><span>프로필사진 변경</span></a></div>
    </div>
  </div>
  <div id="user-item">
    <div><a href="/viewmypost/{{ Auth::user()->name }}"><i class="fas fa-edit"></i> 내가 쓴 글</a></div>
    <div><a href="/noti/{{ Auth::user()->id }}"><i class="fas fa-bell"></i> 내 활동 알림</a></div>
    <div><a href="/chginfor/{{ Auth::user()->id }}"><i class="fas fa-user-edit"></i> 내 정보 변경</a></div>
  </div>
  <div id="logout">
    <a href="/logout">로그아웃</a>
  </div>
  @endif
</br>
{{-- <div class="lb-minipage">
  <div class="lb-minipage-title">미니페이지</div>
  <div class="lb-minipage-search">
    <input type="text" class="lb-minipage-input" style="width: 100%">
    <button class="lb-minipage-result">검색</button>
  </div>
</div> --}}
</div>

