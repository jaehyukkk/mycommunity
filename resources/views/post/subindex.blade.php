@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/board/board.css') }}" >
@endsection
@section('script')
<script  src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/time.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('js/post.js') }}" defer></script>
@endsection
@section('content')
<div>
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
      <th scope="col">작성자</th>
      <th scope="col">조회수</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($notice as $notices )
      @if($notices->notice === 1)
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
        <td>{{ $notices->name }}</td>
        <td>{{ $notices->hit }}</td>  
      </tr>
      @endif
    @endforeach
    @foreach ($notice as $notices )
      @if($notices->notice === 2)
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
        <td>{{ $notices->name }}</td>
        <td>{{ $notices->hit }}</td>  
      </tr>
      @endif
    @endforeach
  </tbody>
  @if($photocode != 1)
  <tfoot id="board-content">
    @foreach ($board as $boards )
    <tr>
      <td scope="row" class="bno">{{ $boards->idx }}</td>
      <td class="Title"><a href="/read/{{ $boards->idx }}">{{ $boards->title }} 
        @if($boards->code > 0)
        <span class="imgicon"><i class="far fa-image"></i></span>
        @endif

        @if($boards->commentnum > 0)
        <span class="commentnum">[{{ $boards->commentnum }}]</span>
        @endif
      </a></td>
      <td class="time">{{ $boards->time }}</td>
      <td>{{ $boards->name }}</td>
      <td>{{ $boards->hit }}</td>  
    </tr>
    @endforeach
  </tfoot>
</table>
@else
</table>
<div id="imgboard">
<div class="container"> 
  <div class="row">
    @foreach ($board as $boards )   
    <div class="col-md-3" id="imgboard-img">
      <a href="/read/{{ $boards->idx }}">
      <img class="img" src="{{$boards->mainimg}}">
    </a>
        <div class="imgBoardTitle"><a href="/read/{{ $boards->idx }}">{{ $boards->title }}</a>
          @if($boards->commentnum > 0)
          <span class="commentnum">[{{ $boards->commentnum }}]</span>
          @endif
        </div>
        <div class="imgBoardName">{{ $boards->name }}</div>
        <div class="time" id="imgBoardTime">{{ $boards->time }}</div>
    </div>  
    @endforeach
  </div>
</div>
</div>
@endif

<input type="hidden" value="{{ $id }}" id="maincategoryId">
<input type="hidden" value="{{ $subid }}" id="subcategoryId">

<div class="mobile-board-box">
  
  
  @foreach ($board as $boards )
  @if($photocode != 1)
    <div class="mobile-board">
      <div class="mobile-board-item" id="mobile-board-sebindex-list">
        <div class="mobile-board-title"><a href="/read/{{ $boards->idx }}">{{ $boards->title }}</a></div>
        <div class="mobile-board-info"><span class="mobile-board-info-name">{{ $boards->name }}</span><span class="time">{{ $boards->time }}</span><span>조회{{ $boards->hit }}</span></div>
      </div>
      <div>
       <div class="mobile-board-commnet">{{ $boards->commentnum }}</div>  
      </div>
    </div> 
    @else
    <div class="mobile-board">
      <div class="mobile-board-content">
      <img class="img" src="{{$boards->mainimg}}">
      <div class="mobile-board-item" id="mobile-board-sebindex-list">
          <div class="mobile-board-title"><a href="/read/{{ $boards->idx }}">{{ $boards->title }}</a></div>
          <div class="mobile-board-info"><span class="mobile-board-info-name">{{ $boards->name }}</span><span class="time">{{ $boards->time }}</span><span>조회{{ $boards->hit }}</span></div>
      </div>
    </div>
      <div>
       <div class="mobile-board-commnet">{{ $boards->commentnum }}</div>  
      </div>

    </div> 
    @endif
    @endforeach
    
  </div>

<div id="board-foot">
  <div>
  </div>
  <div class="paginateBtn"> 
    {{ $board->links('pagination::custom')}}
  </div>
  <div class="createbtn">
    <a href="/board/create/{{ $id }}/{{ $subid }}">글쓰기</a>
  </div>
</div>

<form action="/search">

  <div id="mobile-searchBox">
    <div>
      <div class="mobile-serch-select">
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


{{-- @section('subContent')

<div id="mobile">
  @component('layouts.mobilenav')
  @endcomponent
  <div class="mobile-board-box" id="mobile-sebindex-board-box">
  
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

  <form action="/search">

    <div id="mobile-searchBox">
      <div>
        <div class="mobile-serch-select">
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
  
  </div>
  
  
  @component('layouts.mobilefooter')
  @endcomponent
  
  </div>


@endsection --}}
