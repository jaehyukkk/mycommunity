@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css') }}" >
@endsection
@section('script')
<script  src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/time.js') }}" defer></script>
@endsection
@section('content')
<div class="board">
  <div class="main-free-board">
    <div class="main-free-board-top">
      <div><a href="/viewall">최신글보기</a></div>
      <span><a href="/viewall">더보기</a></span>
    </div>
    <?php $cnt = 0 ;?>
    @foreach ($board as $boards )
    <?php $cnt++ ?>
      @if($cnt == 11)
      <?php break; ?>
      @endif
    <div class="main-free-board-title">
      <div><a href="/read/{{ $boards->idx }}">{{ $boards->title }}</a></div>
      <div><a href="/viewmypost/{{ $boards->writer }}">{{ $boards->writer }}</a></div>
    </div>
    @endforeach
  </div>

  <div class="main-free-board">
    <div class="main-free-board-top">
      <div><a href="/board/1/1">자유</a></div>
      <span><a href="/board/1/1">더보기</a></span>
    </div>
    
      <?php $cnt1 = 0?>
      @foreach ($board as $boards )
      @if($boards->maincategory_id == 1 && $boards->subcategory_id == 1)
      <?php $cnt1++?>
      @if($cnt1 == 11)
      <?php break;?>
      @endif
      <div class="main-free-board-title">
      <div><a href="/read/{{ $boards->idx }}">{{ $boards->title }}</a></div>
      <div><a href="/viewmypost/{{ $boards->writer }}">{{ $boards->writer }}</a></div> 
      </div>       
      @endif
      @endforeach    
  </div>
</div>
@endsection


@section('loginbox')
@component('layouts.loginbox')
@endcomponent
@endsection



@section('subContent')
<div id="mobile">
  @component('layouts.mobilenav')
  @endcomponent
  <div class="mobile-board-box">
  
  @foreach ($board as $boards )
  
    <div class="mobile-board">
      <div class="mobile-board-item">
        <div class="mobile-board-title"><a href="/read/{{ $boards->idx }}">{{ $boards->title }}</a></div>
        <div class="mobile-board-info"><span class="mobile-board-info-name">{{ $boards->name }}</span><span class="time">{{ $boards->time }}</span><span>조회{{ $boards->hit }}</span></div>
        <div class="mobile-board-category">자유게시판</div>
      </div>
      <div>
       <div class="mobile-board-commnet">{{ $boards->commentnum }}</div>  
      </div>
    </div> 
  
    @endforeach
  
  </div>
  
  
  @component('layouts.mobilefooter')
  @endcomponent
  
  </div>
@endsection


