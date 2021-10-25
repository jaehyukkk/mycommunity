@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/board/board.css') }}" >
@endsection
@section('script')
<script  src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/time.js') }}" defer></script>
@endsection
@section('content')
<div class="table-div">

<p style="margin-top: 75px; font-weight: 500;">{{ $name }}님의 작성 글 목록 
  <span style="color:rgb(82, 82, 82); font-weight: 400;">총 : {{ count($searchResult) }}건</span>
</p>

<table class="table" style="margin-top: 10px;">
  <thead>
    <tr>
      <th scope="col" class="bno"></th>
      <th scope="col">제목</th>
      <th scope="col">작성일</th>
      <th scope="col">글쓴이</th>
      <th scope="col">조회수</th>
    </tr>
  </thead>

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


@if(count($searchResult) == 0)
<center class="searchNull"><b>작성한 글이 없습니다.</b>
  </center>
@endif

</div>
@endsection
