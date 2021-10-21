@extends('layouts.admin')
@section('script')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/admin.js') }}" defer></script>
@endsection
@section('content')
    <div>

        <div class="category-titleSubmit">
            <div class="category-titleSubmit-title">
                <p>게시판 관리</p>
            </div>
            <div id="addSubmit">
                <button type="submit">완료</button>
            </div>
        </div>

        

    <div id="categoryBox">
        <div id="category-menu">
            <div id="category-btns">
                <div>
                    <div data-division="0" class="addcategory-btn">상위게시판 추가</div>
                </div>
                <div>
                    <div data-division="1" class="addcategory-btn">하위게시판 추가</div>
                </div>
                <div>
                    <div onclick="removeCheck()">제거</div>
                </div>       
            </div>
            <div id="category-list">
                @foreach ($maincategory as $mains )
                <div class="maincategory" data-id="{{ $mains->id }}">{{ $mains->maincategoryname }}</div>
                @foreach ($subcategory as $subs )
                @if($subs->maincategory_id == $mains->id)
                <div class="subcategory"data-subid ="{{ $subs->id }}">{{ $subs->subcategoryname }}</div>
                @endif        
                @endforeach       
                @endforeach   
            </div>
        </div>

        <div id="add-category">
            <form action="/addcategory" method="post" id="addcategoryForm">
                @csrf
            <div id="category-title">
                <div>
                    <div id="add-category-top">게시판 관리</div>
                </div>      
            </div>
            <div id="add-category-menu">
                <div class="add-category-title">
                    <p>게시판 이름</p>
                    <div class="category-name-input">
                            <input type="text" id="name" class="input" maxlength="20" name="name">
                    </div>
                </div>
                <div class="category-purpose">
                    <p>용도</p>
                    <select name="purpose" id="">
                        <option value="0">일반게시판</option>
                        <option value="1">포토게시판</option>
                    </select>
                    <input type="hidden" id="division" name="division">
                    <input type="hidden" id="categoryid" name="categoryid">
                    <input type="hidden" id="maincategory_id" name="maincategory_id">
                </div>
            </div>
            </form>
        </div>
   

    </div>
</div>
@endsection




