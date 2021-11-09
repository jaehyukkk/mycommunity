@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css?v=').time() }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/board/board.css?v=').time() }}" >
@endsection
@section('script')
<script  src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/time.js?v=').time() }}" defer></script>
@endsection
@section('content')

<div class="table-div">
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
      <th scope="col">글쓴이</th>
      <th scope="col">조회수</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($notice as $notices )
      <tr class="notice">
        <td scope="row" class="noticeText">
          <div>공지</div>
        </td>
        <td class="Title"><a href="/read/{{ $notices->idx }}">{{ $notices->title }}</a>
          @if($notices->code > 0)
          <span class="imgicon"><i class="far fa-image"></i></span>
          @endif
  
          @if($notices->commentnum > 0)
          <span class="commentnum">[{{ $notices->commentnum }}]</span>
          @endif
        </td>
        <td class="time">{{ $notices->time }}</td>
        <td>{{ $notices->writer }}</td>
        <td>{{ $notices->hit }}</td>  
      </tr>
    @endforeach
  </tbody>

  <?php $photoboard = true ?>

  @foreach ($maincategory as $mains )
  @if($mains->id == $id)
  @if($mains->photocode == 0)
  <?php $photoboard = false ?>
  @endif  
  @endif  
  @endforeach
  
  @if($photoboard == false)
  <tfoot>
    @foreach ($board as $boards )
 
    <tr>
      <td scope="row" class="bno" id="subcategoryname">{{ $boards->subcategoryname }}</td>
      <td class="Title"><a href="/read/{{ $boards->idx }}">{{ $boards->title }} 
        @if($boards->code > 0)
        <span class="imgicon"><i class="far fa-image"></i></span>
        @endif

        @if($boards->commentnum > 0)
        <span class="commentnum">[{{ $boards->commentnum }}]</span>
        @endif
      </a></td>
      <td class="time">{{ $boards->time }}</td>
      <td>{{ $boards->writer }}</td>
      <td>{{ $boards->hit }}</td>  
    </tr>
    @endforeach
  </tfoot>
</table>
@else
</table>
<div id="imgboard">
<div class="container"> 
  <div class="row" >
    @foreach ($board as $boards )   
    <div class="col-md-3" id="imgboard-img">
      <a href="/read/{{ $boards->idx }}">
      <img class="img" src="{{$boards->mainimg}}">
    </a>
      <div id="imgboard-text">
        <div class="imgBoardsubcategory">{{ $boards->subcategoryname }}</div>
        <div class="mainimgBoardTitle"><a href="/read/{{ $boards->idx }}">{{ $boards->title }}</a>
          @if($boards->commentnum > 0)
          <span class="commentnum">[{{ $boards->commentnum }}]</span>
          @endif
        </div>
        <div class="imgBoardName">{{ $boards->writer }}</div>
        <div class="time" id="imgBoardTime">{{ $boards->time }}</div>
      </div>
    </div>  
    @endforeach
  </div>
</div>
</div>
@endif


<div class="paginateBtn"> 
  {{ $board->links('pagination::custom')}}
</div>

<form action="/search">

  <div id="searchBox">
    
      <div class="searchSelect">
        <input type="hidden" name="id" value="{{ $id }}">
        <input type="hidden" name="subid" value="0">
        <select name="category" id="">
          <option value="1">제목+내용</option>  
          <option value="2">제목</option>  
          <option value="3">내용</option>  
          <option value="4">작성자</option>  
          <option value="5">댓글</option>  
        </select>
      </div>

      <div class="searchInput">
        <span class="inputbox input_search">
          <input type="text" id="search" class="input" maxlength="20" name="search">
        </span>
      </div>
      
      <div class="searchSubmit">
         <input type="submit" value="검색">
      </div>
    </div>
  </form>

</div>
@endsection
