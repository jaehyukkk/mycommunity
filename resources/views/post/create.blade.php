@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/summernote/summernote-lite.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/summernote/css.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/board/board.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/mobilesummernote/summernote-lite.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/mobilesummernote/css.css') }}" >
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" defer></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
<script type="text/javascript" src="{{ URL::asset('/summernote/summernote-lite.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('/summernote/js.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('/summernote/lang/summernote-ko-KR.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('/js/create.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('/mobilesummernote/mobilesummernote-lite.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('/mobilesummernote/js.js') }}" defer></script>
<script>


</script>
@endsection
@section('error')
  @if ($errors->any())
        @foreach ($errors->all() as $error)
            <?php 
            echo "<script>
              alert('$error');
              </script>"
            ?>
        @endforeach 
  @endif
@endsection
@section('content')
<form action="/board/store" method="post">
  @csrf
      <div class="container" id="create-container">
          <div id="container-title"  data-id ={{ $subid }}></div>
          <span class="box title" id="create-title">
              <input type="text" placeholder="제목을 입력하세요." name="title"class="create-title"><br>
           </span>
          <textarea id="summernote" name="description"></textarea>  
          
          <input type="hidden" name="caid" value="{{ $id }}">
          <input type="hidden" name="subid" value="{{ $subid }}">
          <div id="create-option">
              <div>
                @auth('admin')
                  <span>공지설정</span>
                  <select name="notice">
                      <option value="0">선택안함</option>
                      <option value="1">전체공지</option>
                      <option value="2">게시판공지</option>
                  </select>
                @endauth
              </div>
              <div>
                  <input type="submit" value="등록">
              </div>
          </div>
          
          
      </div>
      
  </form>
  @endsection
  @section('subContent')
  
  <div id="mobile">
    <form action="/board/store" method="post">
      @csrf
        <input type="hidden" name="caid" value="{{ $id }}">
        <input type="hidden" name="subid" value="{{ $subid }}">
        <input type="hidden" name="notice" value="0">
    <div id="mobile-create-nav">
      <div id="mobile-create-nav-item">
        <div><i class="fas fa-chevron-left"></i></div>
        <div>글쓰기</div>
        <button type="submit">등록</button>
      </div>
    </div>
    <div id="mobile-container">
    <div id="mobile-container-title"  data-id ={{ $subid }}></div>
   </div>
    <center><input type="text" placeholder="제목을 입력하세요." class="mobile-create-title" name="title"></center>
    <textarea id="mobile-summernote" name="description"></textarea>  
    </form>
  </div>
  @endsection