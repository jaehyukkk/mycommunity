<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/summernote/summernote-lite.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/summernote/css.css') }}" >
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> --}}
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('/summernote/summernote-lite.js') }}" defer></script>
    <script type="text/javascript" src="{{ URL::asset('/summernote/js.js') }}" defer></script>
    <script type="text/javascript" src="{{ URL::asset('/summernote/lang/summernote-ko-KR.js') }}" defer></script>


    <form action="/board/store" method="post">
    @csrf
        <div class="container">
            <textarea id="summernote" name="description"></textarea>    
        </div>
        <input type="submit">
    </form>


</body>
</html>