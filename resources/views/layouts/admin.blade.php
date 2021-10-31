<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/t/bs-3.3.6/jqc-1.12.0,dt-1.10.11/datatables.min.css"/> 
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/admin/admin.css') }}" >

    <title>Hello, world!</title>
  </head>
  <body>
    @section('script')
     <script  src="https://code.jquery.com/jquery-latest.min.js" defer></script>
    @show

    <script>
      var msg = '{{Session::get('alert')}}';
      var exist = '{{Session::has('alert')}}';
      if(exist){
          alert(msg);
      }
    </script>
    
    <script src="https://kit.fontawesome.com/db98d81eec.js" 
    crossorigin="anonymous" defer>
    </script>

    <nav id="admin-logo">
      <div><a href="#"><i class="fas fa-user-cog"></i> LTL ADMINPAGE</a></div>
    </nav>

    <nav id="admin-nav">
      <ul>
        <li><a href="/admin">
          <div><i class="fas fa-cog fa-2x"></i></div>  
          <div>관리 홈</div>  
        </a></li>
        <li><a href="/admin/category">
          <div><i class="fas fa-chalkboard-teacher fa-2x"></i></div>
          <div>게시판</div>
        </a></li>
        <li><a href="/admin/users">
          <div><i class="fas fa-users fa-2x"></i></div>  
          <div>회원</div>  
        </a></li>
        <li><a href="/admin/post">
          <div><i class="fas fa-list fa-2x"></i></div>  
          <div>게시글</div>  
        </a></li>
        <li><a href="/admin/comment">
          <div><i class="fas fa-comment-dots fa-2x"></i></div>  
          <div>댓글</div>  
        </a></li>
        <li><a href="/admin/reply">
          <div><i class="fas fa-reply fa-2x"></i></div>  
          <div>답글</div>  
        </a></li>
        <li><a href="/admin/logout">
          <div><i class="fas fa-sign-out-alt fa-2x"></i></div>  
          <div>로그아웃</div>  
        </a></li>
      </ul>
    </nav>

    @yield('content')





 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>