@extends('layouts.admin')
@section('script')
<script src="https://code.jquery.com/jquery-3.3.1.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js" defer></script>
<script type="text/javascript" src="{{ URL::asset('js/admin.js') }}" defer></script>
@endsection
@section('content')
    
    <div class="table">

        <p class="table-title">댓글 모아보기</p>
    <table id="table_id" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>번호</th>
                <th>댓글내용</th>
                <th>본문제목</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comment as $comments )           
            <tr>
                <td>{{ $comments->id }}</td>
                <td>{!! $comments->comment_content !!}</td>
                <td>{{ $comments->title }}</td>
                <td>{{ $comments->comment_writer }}</td>
                <td>{{ $comments->time }}</td>
            </tr>
            @endforeach
        </tbody>
</table>
</div>

@endsection


