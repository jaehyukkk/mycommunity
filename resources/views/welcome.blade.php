@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css?v=').time() }}" >
@endsection
@section('script')
<script  src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/time.js?v=').time()}}" defer></script>
@endsection
@section('content')
<div class="main-content">
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
      <div><a href="/board/1/12">자유게시판</a></div>
      <span><a href="/board/1/12">더보기</a></span>
    </div>
    
      <?php $cnt1 = 0?>
      @foreach ($board as $boards )
      @if($boards->maincategory_id == 1 && $boards->subcategory_id == 12)
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
{{-- <div class="lb-rank">
  <div class="lb-rank-title">
    <div>금일 신의손가락 TOP 5</div>
  </div>
  <div class="rank-box">
    @foreach ($rank->find('#recent1') as $ranks)
      {!! $ranks !!}
    @endforeach
    </div>
    <div class="lb-rank-foot">
      <div><a href="https://lovebeat.plaync.com">출처 : https://lovebeat.plaync.com</a></div>
    </div>
  </div> --}}
</div>

@endsection
@section('loginbox')
@component('layouts.loginbox')
@endcomponent
@endsection




