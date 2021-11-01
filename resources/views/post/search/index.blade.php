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




<div class="mobile-board-box">
  <div class="main-free-board-top">
    <div><a href="#">검색</a></div>
  </div>
  
  @foreach ($searchResult as $search )
  @if($photocode != 1)
    <div class="mobile-board">
      <div class="mobile-board-item" id="mobile-board-sebindex-list">
        <div class="mobile-board-title"><a href="/read/{{ $search->idx }}">{{ $search->title }}</a></div>
        <div class="mobile-board-info"><span class="mobile-board-info-name">{{ $search->name }}</span><span class="time">{{ $search->time }}</span><span>조회{{ $search->hit }}</span></div>
      </div>
      <div>
       <div class="mobile-board-commnet">{{ $search->commentnum }}</div>  
      </div>
    </div> 
    @else
    <div class="mobile-board">
      <div class="mobile-board-content">
      <img class="img" src="{{$search->mainimg}}">
      <div class="mobile-board-item" id="mobile-board-sebindex-list">
          <div class="mobile-board-title"><a href="/read/{{ $search->idx }}">{{ $search->title }}</a></div>
          <div class="mobile-board-info"><span class="mobile-board-info-name">{{ $search->name }}</span><span class="time">{{ $search->time }}</span><span>조회{{ $search->hit }}</span></div>
      </div>
    </div>
      <div>
       <div class="mobile-board-commnet">{{ $search->commentnum }}</div>  
      </div>

    </div> 
    @endif
    @endforeach
    
  </div>


  <form action="/search">

  <div id="mobile-searchBox">
    <div>
      <div class="mobile-serch-select">
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
      
      <div class="mobile-serch-result">
      <div class="searchInput">
        <span class="inputbox input_search">
          <input type="text" id="search" class="input" maxlength="20" name="search">
        </span>
      </div>
      
      <div class="searchSubmit">
         <input type="submit" value="검색">
      </div>
    </div>

  </div>
  </div>
  </form>
@endsection
