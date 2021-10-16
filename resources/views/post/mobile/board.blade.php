<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/board/board.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/board/comment.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('/summernote/summernote-lite.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('/summernote/css.css') }}" >
    <title>Hello, world!</title>
  </head>
  <body>
    <script  src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('/summernote/summernote-lite.js') }}" defer></script>
    <script type="text/javascript" src="{{ URL::asset('/summernote/js.js') }}" defer></script>
    <script type="text/javascript" src="{{ URL::asset('js/comment.js') }}" defer></script>
    <script type="text/javascript" src="{{ URL::asset('/ckeditor_review/ckeditor/ckeditor.js') }}" defer></script>
    <script type="text/javascript" src="{{ URL::asset('/ckeditor_review/ckeditor/adapters/jquery.js') }}" defer></script>

    <script>
      var msg = '{{Session::get('alert')}}';
      var exist = '{{Session::has('alert')}}';
      if(exist){
          alert(msg);
      }
    </script>
    
    <script src="https://kit.fontawesome.com/db98d81eec.js" 
    crossorigin="anonymous">
    </script>


  
<div id="mobile">
  <div id="mobile-nav">
    <div><i class="fas fa-chevron-left"></i></div>
    <div>LBL</div>
    <div class="mobile-login"><i class="fas fa-sign-in-alt"></i></div>
  </div>

  <div class="mobile-board-list">
 
      @foreach ($main as $mains )
      <div class="mobile-mainCategory">{{ $mains->maincategoryname }}</div>
        @foreach ($sub as $subs )
            @if($subs->maincategory_id == $mains->id)
            <div class="mobile-subCategory"><a href="/board/{{ $mains->id }}/{{ $subs->id }}">{{ $subs->subcategoryname }}</a></div>
            @endif
        @endforeach
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

  

 



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>