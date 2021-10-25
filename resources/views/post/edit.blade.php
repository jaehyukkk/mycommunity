@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/summernote/summernote-lite.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/summernote/css.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/board/board.css') }}" >
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js" defer></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" defer></script>
<script type="text/javascript" src="{{ URL::asset('/summernote/summernote-lite.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('/summernote/js.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('/summernote/lang/summernote-ko-KR.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('/js/post.js') }}" defer></script>
@endsection

@section('content')
<form action="/update/{{ $post->id }}" method="post">
  @csrf
 <div class="container" id="create-container">
     <div id="container-title" data-id ={{ $post->subcategory_id }}></div>
     <span class="box title" id="create-title">    
          
         <input type="text" placeholder="제목을 입력하세요." name="title"class="create-title"
         value="{{ $post->title }}"
         ><br>
      </span>
     <textarea id="summernote" name="description">{{ $post->description }}</textarea>  
     <input type="hidden" name="caid" value="{{ $post->maincategory_id }}">
     <input type="hidden" name="subid" value="{{ $post->subcategory_id }}">
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

