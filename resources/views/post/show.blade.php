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

<div id="main-logo">
  <div id ="mainTop">
    <h1>LOVEBEAT</br>TALK</br>LOUNGE</h1>
  </div>
</div>

<nav role="navigation">
  <ul id="main-menu" class="main-menu-board">
    @foreach ($maincategory as $maincategorys )  
    <li><a href="/board/{{ $maincategorys->id }}">{{ $maincategorys->maincategoryname }}</a>
      <ul id="sub-menu">
        @foreach ($subcategory as $subcategorys)
          @if($maincategorys->id === $subcategorys->maincategory_id)
          <li id="main-menu-board"><a href="/board/{{ $maincategorys->id }}/{{ $subcategorys->id }}" aria-label="subemnu">{{ $subcategorys->subcategoryname }}</a></li>
          @endif
        @endforeach      
      </ul>
    </li>
    @endforeach
  </ul>
</nav>





<article id="main">
  <article class="read-main">
    <div class="read-baord-box">
        @foreach ($read as $reads )    
        <div class="read-board">{{ $reads->subcategoryname }}</div>
        <div class="title-profil">
        <div class="read-title">{{ $reads->title }}</div>

        <div class="read-profil">
          <div class="read-profil-img">
              <img src="{{URL::asset('/img/img.JPG')}}" alt="...">
          </div>   
          <span class="read-profil-name">{{ $reads->name }}</span>
        </div>
      </div>
      <?php $commentCount = count($comment) + count($reply) ?>
            <div class="read-data">
                <div class="read-data-1">
                    
                    <span class="read-time">{{ $reads->time }}</span>
                </div>
                <div class="read-data-2">
                    <span>조회수<span class="read-num">{{ $reads->hit }}</span></span>
                    <span>댓글<span class="read-num">{{ $commentCount }}</span></span>
                </div>       
            </div>

            <div class="board-content">
                {!! $reads->description !!}
            </div>
            @endforeach

            <div class="comment-title">
              <i class="far fa-comment-dots"></i> 
              <span class="comment-title-title">댓글</span>
              <span class="comment-title-count">{{ $commentCount }}</span>
            </div>

        
             <footer class="comment-box"> 
            <div class="review-box">
              @foreach ($comment as $comments )
              
              <div class="reviews-box">
            
                <article class="comment">
                  <div class="comment-name">
                    <div class="replyWriter">
                      <img src="{{URL::asset('/img/img.JPG')}}" alt="..."> 
                      <span>{{ $comments->comment_writer }}</span>
                      <span class="comment-time">{{ $comments->created_at }}</span>
                    </div>
                    <div class="replyALink">
                      <a href="#"class="commentReplyBtn" data-reply="{{ $comments->id }}">답글</a>
                   </div>
                    
                  </div>
                    <p class="replyContent" >{!! $comments->comment_content !!}</p>
                    <input type="hidden" data-update="{{ $comments->id }}" value="{{$comments->comment_content  }}">
        
                    <div class="replyPhotoBox">
                      <?php $photo = json_decode($comments->comment_photo)?>
                      @for($i = 0; $i < count($photo) ; $i++)
                      <div>
                        <img class="replyPhotos" src="{{URL::asset('/image/'.$photo[$i])}}">
                      </div>          
                      @endfor   
                    </div> 
                  
                    @if(Auth::user())
                      @if(Auth::user()->id === $comments->user_id)
                    <div class="reviewupdelBtn" id="commentBtns">             
                        <a href="#"class="commentUpdateBtn" data-update="{{ $comments->id }}">수정</a>
                        <a href="#" class="commentDelBtn" data-commentdel="{{ $comments->id }}" data-toggle="modal" data-target="#commentDelModal">
                          삭제
                        </a>   
                                  
                    </div>
                      @endif
                    @endif
                </article>

                    {{-- 답글 폼 --}}
                  
                    <div data-reply ="{{ $comments->id }}" class="updatediv">
                      <input type="hidden" value="{{ $read[0]->idx }}" id="hidden-postid">
                    </div>
                      {{-- 답글 폼 끝 --}}

                    
                    {{-- 댓글 수정 폼 --}}
                    
                    <div data-updateform ="{{ $comments->id }}" class="updatediv">
                    </div>
                    
                    {{-- 댓글 수정 폼 끝 --}}


                      <div id="reply-box">
                          @foreach ($reply as $replys )
                          <article class="reply">
                          @if($replys->comment_id == $comments->id)
                          
                          <div class=writerStar>
                            <div class="replyWriter"><img src="{{URL::asset('/img/img.JPG')}}" alt="..."> <span>{{ $replys->reply_writer }}</span>
                              <span class="comment-time">{{ $replys->created_at }}</span>
                            </div>      
                          </div>
                            <p class="replyContent" >{!! $replys->reply_content !!}</p>
                            <input type="hidden" data-replyupdate="{{ $replys->id }}" value="{{$replys->reply_content  }}">
                
                            <div class="replyPhotoBox">
                             
                              <?php $photo = json_decode($replys->reply_photo)?>
                              @for($i = 0; $i < count($photo) ; $i++)
                              <div>
                                <img class="replyPhotos" src="{{URL::asset('/image/'.$photo[$i])}}">
                              </div>          
                              @endfor   
                           
                            </div> 
                
                            @if(Auth::user())
                              @if(Auth::user()->id === $replys->user_id)
                            <div class="reviewupdelBtn" id="replyBtns">
                              <a href="#"class="replyUpdateBtn" data-replyupdate="{{ $replys->id }}">수정</a>
                              <a href="#" class="replyDelBtn" data-replydel="{{ $replys->id }}" data-toggle="modal" data-target="#replyDelModal">
                                삭제
                              </a>               
                            </div>


                            {{-- 답글 수정 폼 --}}

                            <div data-replyupdateform ="{{ $replys->id }}" class="updatediv">
                            </div>

                            {{-- 답글 수정 폼 끝 --}}

                              @endif
                            @endif
                          @endif
                        </article>
                        @endforeach
                          
                    </div>
                   
                </div>          
              @endforeach
            </div>
   

            <div>  
                <form action="/commentcreate" method="post" id="form" enctype="multipart/form-data">
                    @csrf
                      <div class="review">
                                           
                            <textarea class="form-control" id="editor1" name="reply_content" ></textarea>
                            
                            <script>
                            $( document ).ready( function() {
                              $( 'textarea#editor1' ).ckeditor();
                          } );
                          </script>
                        
                          <input type="hidden" class="ckeditorval" name="comment_content">
                          <input type="hidden" name="replycode" value="0">
                          <div class="commentitem">
                            <div class="filebox"> 
              
                              <a href="javascript:" onclick="fileUploadAction();" class="my_button"><i class="fas fa-camera"></i> 사진첨부</a>
                          <input type="file" id="input_imgs" name="comment_photo[]"multiple/>
                            </div>
                            <div>
              
                            <button class="reviewBtn" type="submit">등록</button>
                            </div>
                         </div>
                         <div class="imgs_wrap">
                          
                        </div>
                        
                        <input type="hidden" name="postid" value="{{ $read[0]->idx }}">
                    </form>
            </div>
         
          </div>
        </footer>
          
            
    </div>
    <div id="read-foot-1">
      <div id="read-updataDeleteBtn">
        <div id="read-updataDeleteBtn-update">
        <a href="/edit/{{ $read[0]->idx }}">수정</a>
        </div>      
        <form action="/destroy/{{ $read[0]->idx }}" method="post">
        @csrf
        <div id="read-updataDeleteBtn-delete">
          <button type="submit">삭제</button>
        </div>
        </form>    
      </div>
      <div id="read-return">
        <div><a href="">목록</a></div>
      </div>
    </div>
  </article>



    <div id="loginBox">
      @if(Auth::guest())
      <div id="loginForm">
        <div id="loginForm-input">
          <form action="/login" method="post">
            @csrf     
          <input type="text" name="userid">
           </br>
          <input type="password" name="password">
        </div>
        <div id="loginForm-submit">
          <button type="submit">로그인</button>
        </form>
        </div>
      </div>
      <div id="loginSubMenu">
        <div>회원가입</div>
        <div>아이디/비밀번호 찾기</div>
      </div>
      <center><div class="loginborder"></div></center>
      <div id="socialLogin">
        <button><i class="fab fa-google-plus-g"></i>GoogleLogin</button>
      </div>
      @else
      <div id="username">
        <div><img src="{{URL::asset('/img/img.JPG')}}" alt=""></div>
        <div><b>{{ Auth::user()->name }}</b></div>
      </div>
      <div id="usermenu">
        <div>
        <div class="usermenu-item">
          <button>내가 쓴 글</button>
          <button>내가 쓴 댓글</button>
        </div>
        <div class="usermenu-item">
          <button>내 활동 알림</button>
          <button>쪽지함</button>
        </div>
        <div id="logout">
          <a href="/logout"><button>로그아웃</button></a>
        </div>
        </div>
      </div>
    
       @endif
       
    </div>
  
</article>

<div class="modal fade" id="commentDelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">게시물 삭제</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        댓글을 정말 삭제하시겠습니까?
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="commentDelModalBtn" data-postid="{{ $read[0]->idx }}">삭제하기</button>
           <button type="button" class="btn btn-secondary" data-dismiss="modal">취소하기</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="replyDelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">게시물 삭제</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        답글을 정말 삭제하시겠습니까?
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="replyDelModalBtn" data-postid="{{ $read[0]->idx }}">삭제하기</button>
           <button type="button" class="btn btn-secondary" data-dismiss="modal">취소하기</button>
      </div>
    </div>
  </div>
</div>


  
<div id="mobile">
  <div id="mobile-nav">
    <div><i class="fas fa-chevron-left"></i></div>
    <div>LBL</div>
    <div class="mobile-login"><i class="fas fa-sign-in-alt"></i></div>
  </div>
  <div class="mobile-read-box">
  @foreach ($read as $reads )
  <div class="mobile-read-top">
    <div class="mobile-read-boardName">{{ $reads->subcategoryname }}</div>
    <div class="mobile-read-title">{{ $reads->title }}</div>
    <div class="mobil-read-infor">
      <div class="mobile-read-profil-img">
        <img src="{{URL::asset('/img/img.JPG')}}" alt="...">
      </div>
      <div class="mobile-read-top-item">
        <div>{{ $reads->name }}</div>
        <div>
          <span class="time">{{ $reads->time }}</span>
          <span>조회 {{ $reads->hit }}</span>
        </div>
      </div>
    </div>
  </div>
 
  <div class="mobile-read-description">
    {!! $reads->description !!}
  </div>
  </div>
  @endforeach

  <footer class="mobile-comment-box"> 
    <div class="review-box">
      @foreach ($comment as $comments )
      
      <div class="reviews-box">
    
        <article class="comment">
          <div class="comment-name">
            <div class="mobile-comment-item">
              <img src="{{URL::asset('/img/img.JPG')}}" alt="..."> 
              <span class="mobile-comment-writer">{{ $comments->comment_writer }}</span>
              <span class="comment-time">{{ $comments->created_at }}</span>
            </div>
            <div class="replyALink">
           </div>
            
          </div>
            <p class="replyContent" >{!! $comments->comment_content !!}</p>
            <input type="hidden" data-update="{{ $comments->id }}" value="{{$comments->comment_content  }}">

            <div class="replyPhotoBox">
              <?php $photo = json_decode($comments->comment_photo)?>
              @for($i = 0; $i < count($photo) ; $i++)
              <div>
                <img class="replyPhotos" src="{{URL::asset('/image/'.$photo[$i])}}">
              </div>          
              @endfor   
            </div> 
          
            @if(Auth::user())
              @if(Auth::user()->id === $comments->user_id)
            <div class="reviewupdelBtn" id="commentBtns">             
                <a href="#" class="commentDelBtn" data-commentdel="{{ $comments->id }}" data-toggle="modal" data-target="#commentDelModal">
                  삭제
                </a>   
                          
            </div>
              @endif
            @endif
        </article>

            {{-- 답글 폼 --}}
          
            <div data-reply ="{{ $comments->id }}" class="updatediv">
              <input type="hidden" value="{{ $read[0]->idx }}" id="hidden-postid">
            </div>
              {{-- 답글 폼 끝 --}}

            
            {{-- 댓글 수정 폼 --}}
            
            <div data-updateform ="{{ $comments->id }}" class="updatediv">
            </div>
            
            {{-- 댓글 수정 폼 끝 --}}


              <div id="reply-box">
                  @foreach ($reply as $replys )
                  <article class="reply">
                  @if($replys->comment_id == $comments->id)
                  
                  <div class=writerStar>
                    <div class="replyWriter"><img src="{{URL::asset('/img/img.JPG')}}" alt="..."> <span>{{ $replys->reply_writer }}</span>
                      <span class="comment-time">{{ $replys->created_at }}</span>
                    </div>      
                  </div>
                    <p class="replyContent" >{!! $replys->reply_content !!}</p>
                    <input type="hidden" data-replyupdate="{{ $replys->id }}" value="{{$replys->reply_content  }}">
        
                    <div class="replyPhotoBox">
                     
                      <?php $photo = json_decode($replys->reply_photo)?>
                      @for($i = 0; $i < count($photo) ; $i++)
                      <div>
                        <img class="replyPhotos" src="{{URL::asset('/image/'.$photo[$i])}}">
                      </div>          
                      @endfor   
                   
                    </div> 
        
                    @if(Auth::user())
                      @if(Auth::user()->id === $replys->user_id)
                    <div class="reviewupdelBtn" id="replyBtns">
                      <a href="#" class="replyDelBtn" data-replydel="{{ $replys->id }}" data-toggle="modal" data-target="#replyDelModal">
                        삭제
                      </a>               
                    </div>


                    {{-- 답글 수정 폼 --}}

                    <div data-replyupdateform ="{{ $replys->id }}" class="updatediv">
                    </div>

                    {{-- 답글 수정 폼 끝 --}}

                      @endif
                    @endif
                  @endif
                </article>
                @endforeach
                  
            </div>
           
        </div>          
      @endforeach
    </div>


    <div>  
        <form action="/commentcreate" method="post" id="form" enctype="multipart/form-data">
            @csrf
              <div class="review">
                                   
                    <textarea class="form-control" id="editor1" name="reply_content" ></textarea>
                    
                    <script>
                    $( document ).ready( function() {
                      $( 'textarea#editor1' ).ckeditor();
                  } );
                  </script>
                
                  <input type="hidden" class="ckeditorval" name="comment_content">
                  <input type="hidden" name="replycode" value="0">
                  <div class="commentitem">
                    <div class="filebox"> 
      
                      <a href="javascript:" onclick="fileUploadAction();" class="my_button"><i class="fas fa-camera"></i> 사진첨부</a>
                  <input type="file" id="input_imgs" name="comment_photo[]"multiple/>
                    </div>
                    <div>
      
                    <button class="reviewBtn" type="submit">등록</button>
                    </div>
                 </div>
                 <div class="imgs_wrap">
                  
                </div>
                
                <input type="hidden" name="postid" value="{{ $read[0]->idx }}">
            </form>
    </div>
 
  </div>
</footer>
  
  <div id="footer">
    <div class="mobile-footer-item">
      <span><i class="far fa-address-card"></i></span>
      <span><i class="fas fa-search"></i></span>
      <span><a href="/mobile/board"><i class="fas fa-bars"></i></a></span>
    </div>
  </div>
  
  </div>


 <script>
   $(function(){
    $('.mobile-read-description')
    .children('p')
    .children('img')
    .attr('style','width: 100%');
   })
   
 </script>
  

 



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>