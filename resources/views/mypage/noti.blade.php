@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css?v=').time() }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/board/board.css?v=').time() }}" >

@endsection
@section('script')
<script  src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/time.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('js/mypage.js') }}" defer></script>
@endsection
@section('content')
<div>

  <p style="margin-top: 75px; font-weight: 500;">{{ Auth::user()->name }}님의 활동 알림
    <span style="color:rgb(82, 82, 82); font-weight: 400;">총 : {{ count($noti) }}건</span>
  </p>

  <form action="/deletenoti" method="post" id="deleteNotiForm">
    @csrf
<table class="table" style="margin-top: 10px;">
  <thead>
    <tr>
      <th scope="col"><input type="checkbox" id="notiAllCheck" onclick="allCheck(this.id)"></th>
      <th scope="col">구분</th>
      <th scope="col">알림</th>
      <th scope="col">날짜</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($noti as $notis )
    <?php $division = "";
    if($notis->noti_code == 1){
        $division = '댓글';
    }
    else{
        $division = '답글';
    }
    ?>
    
      <tr>
        <td><input type="checkbox" value="{{ $notis->id }}" name="delete[]"></td>
        <td>{{ $division }}</td>
        <td class="Title">[ <a href="/read/{{ $notis->post_id }}"><span style="font-size:15px" class="notisTitle" name="notistitle">{{ $notis->noti_content }}</span></a> ]
        <span>에 새 {{ $division }}이 달렸습니다.</span>
        </td>
        <td>{{ $notis->created_at }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

@if(count($noti) == 0)
<center class="searchNull"><b>활동알림이 없습니다.</b>
  </center>
@endif

<div class="notiDel">
  <span>선택 사항을 : </span>
  <span id="deleteNotiBtn">삭제</span>
</div>

</form>
<div class="paginateBtn"> 
    {{ $noti->links('pagination::custom')}}
</div>
</div>

@endsection

