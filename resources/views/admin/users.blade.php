@extends('layouts.admin')
@section('script')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/admin.js') }}" defer></script>
@endsection
@section('content')
<div class="table">

    <p class="table-title">회원 관리</p>

<table id="table_id" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>아이디</th>
            <th>이름</th>
            <th>이메일</th>
            <th>등급</th>
            <th>비고</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $users )           
        <tr>
            <td>{{ $users->userid }}</td>
            <td>{{ $users->name }}</td>
            <td>{{ $users->email }}</td>
            <td>{{ $users->level }}</td>
            <td>
                <form action="/deleteuser" method="post" id="userdeleteForm">
                @csrf
                <input type="hidden" name="id" value="{{ $users->id }}">
                <button class="deleteUser">제명</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection