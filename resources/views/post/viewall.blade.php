@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css?v=').time() }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/board/board.css?v=').time() }}" >
@endsection
@section('script')
<script  src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/time.js') }}" defer></script>
@endsection
@section('content')

<div class="table-div">
  <div class="board-top">
    <div>
      <h2><a href="#">최신글보기</a></h2>
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
        <td class="Title">{{ $notices->title }}</td>
        <td class="time">{{ $notices->time }}</td>
        <td>{{ $notices->writer }}</td>
        <td>{{ $notices->hit }}</td>  
      </tr>
    @endforeach
  </tbody>

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

<div class="mobile-board-box">
  
  @foreach ($board as $boards )
  
    <div class="mobile-board">
      <div class="mobile-board-item" id="mobile-board-sebindex-list">
        <div class="mobile-board-title"><a href="/read/{{ $boards->idx }}">{{ $boards->title }}</a></div>
        <div class="mobile-board-info"><span class="mobile-board-info-name">{{ $boards->name }}</span><span class="time">{{ $boards->time }}</span><span>조회{{ $boards->hit }}</span></div>
      </div>
      <div>
       <div class="mobile-board-commnet">{{ $boards->commentnum }}</div>  
      </div>
    </div> 
  
    @endforeach
  
  </div>

<div class="paginateBtn"> 
  {{ $board->links('pagination::custom')}}
</div>
<form action="/search">



  {{-- 검색 모바일전용 --}}
  <div id="mobile-searchBox">
    <div>
      <div class="mobile-serch-select">
        <input type="hidden" name="id" value="0">
        <input type="hidden" name="subid" value="0">
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

  {{-- 검색 모바일 전용 끝 --}}


<form action="/search">

  <div id="searchBox">
    
      <div class="searchSelect">
        <input type="hidden" name="id" value="0">
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

@endsection
