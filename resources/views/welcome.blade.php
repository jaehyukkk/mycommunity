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
      <div>최신글보기</div>
      <span>더보기</span>
    </div>
    <?php $cnt = 0 ;?>
    @foreach ($board as $boards )
    <?php $cnt++ ?>
      @if($cnt == 11)
      <?php break; ?>
      @endif
    <div class="main-free-board-title">
      <div><a href="/read/{{ $boards->idx }}">{{ $boards->title }}</a></div>
      <div>{{ $boards->writer }}</div>
    </div>
    @endforeach
   
  </div>

  <div class="main-free-board">
    <div class="main-free-board-top">
      <div>자유게시판</div>
      <span>더보기</span>
    </div>
    
      <?php $cnt1 = 0?>
      @foreach ($board as $boards )
      @if($boards->maincategory_id == 1 && $boards->subcategory_id == 1)
      <?php $cnt1++?>
      @if($cnt1 == 11)
      <?php break;?>
      @endif
      <div class="main-free-board-title">
      <div>{{ $boards->title }}</div>
      <div>{{ $boards->writer }}</div> 
      </div>       
      @endif
      @endforeach    
  </div>
</div>
@endsection




@section('subContent')
<div id="mobile">
  <div id="mobile-nav">
    <div><i class="fas fa-chevron-left"></i></div>
    <div>LBL</div>
    <div><i class="fas fa-sign-in-alt"></i></div>
  </div>
  <div class="mobile-board-box">
  
  @foreach ($board as $boards )
  
    <div class="mobile-board">
      <div class="mobile-board-item">
        <div><a href="/read/{{ $boards->idx }}">{{ $boards->title }}</a></div>
        <div><span>{{ $boards->name }}</span><span class="time">{{ $boards->time }}</span><span>조회{{ $boards->hit }}</span></div>
        <div>자유게시판</div>
      </div>
      <div>
       <div class="mobile-board-commnet">{{ $boards->commentnum }}</div>  
      </div>
    </div> 
  
    @endforeach
  
  </div>
  
  
  <div id="footer">
    <div class="mobile-footer-item">
      <span><i class="far fa-address-card"></i></span>
      <span><i class="fas fa-search"></i></span>
      <span><a href="/mobile/board"><i class="fas fa-bars"></i></a></span>
    </div>
  </div>
  
  </div>
@endsection
