@extends('layouts.admin')
@section('script')
<script src="https://code.jquery.com/jquery-3.3.1.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js" defer></script>
<script type="text/javascript" src="{{ URL::asset('js/admin.js?v=').time() }}" defer></script>
@endsection
@section('content')
    
    <div class="table">

        <p class="table-title">답글 모아보기</p>
    <table id="table_id" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>번호</th>
                <th>답글내용</th>
                <th>상위댓글</th>
                <th>본문제목</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reply as $replys )           
            <tr>
                <td>{{ $replys->id }}</td>
                <td>{!! $replys->reply_content !!}</td>
                <td>{!! $replys->comment_content !!}</td>
                <td>{{ $replys->title }}</td>
                <td>{{ $replys->reply_writer }}</td>
                <td>{{ $replys->time }}</td>
            </tr>
            @endforeach
        </tbody>
</table>
</div>

@endsection


