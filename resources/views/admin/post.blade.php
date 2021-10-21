@extends('layouts.admin')
@section('script')
<script src="https://code.jquery.com/jquery-3.3.1.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js" defer></script>
<script type="text/javascript" src="{{ URL::asset('js/admin.js') }}" defer></script>
@endsection
@section('content')
    
    <div class="table">

        <p class="table-title">게시글 관리</p>
<form action="/admin/delete" method="post" id="deleteForm">
    @csrf
    <table id="table_id" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="table-checkbox"><input type="checkbox" id="postAllCheck" onclick="allCheck(this.id)"></th>
                <th>번호</th>
                <th>제목</th>
                <th>카테고리</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($board as $boards )           
            <tr>
                <td class="table-checkbox"><input type="checkbox" value="{{ $boards->idx }}" name="checkdid[]"></td>
                <td>{{ $boards->idx }}</td>
                <td>{{ $boards->title }}</td>
                <td>{{ $boards->subcategoryname }}</td>
                <td>{{ $boards->writer }}</td>
                <td>{{ $boards->time }}</td>
            </tr>
            @endforeach
        </tbody>
</table>
<button class="deleteBtn">삭제</button>
</form>
</div>

@endsection


