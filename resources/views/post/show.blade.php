@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/board/board.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/board/comment.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/summernote/summernote-lite.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/summernote/css.css') }}" >
@endsection

@section('script')
<script  src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('/summernote/summernote-lite.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('/summernote/js.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('js/comment.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('js/post.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('/ckeditor_review/ckeditor/ckeditor.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('/ckeditor_review/ckeditor/adapters/jquery.js') }}" defer></script>
@endsection
@section('content')
<article class="read-main">
  <div class="read-baord-box">
      @foreach ($read as $reads )    
      <div class="read-board">{{ $reads->subcategoryname }}</div>
      <div class="title-profil">
      <div class="read-title">{{ $reads->title }}</div>

      <div class="read-profil">
        <div class="read-profil-img">
            @if($reads->img == null)
            <img src="{{URL::asset('/image/img.JPG')}}" alt="...">
            @else
            <img src="{{URL::asset('/image/'.$reads->img)}}" alt="...">
            @endif         
        </div>   
        <span class="read-profil-name">{{ $reads->writer }}</span>
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
                  <div class="comment-name-box">
              
                    <img src="{{URL::asset('/image/'.$comments->img)}}" alt="..."> 
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
      
                  <div class="reviewupdelBtn" id="commentBtns">     
                    @can('edit-post', $comments)        
                      <a href="#"class="commentUpdateBtn" data-update="{{ $comments->id }}">수정</a>
                      <a href="#" class="commentDelBtn" data-commentdel="{{ $comments->id }}" data-toggle="modal" data-target="#commentDelModal">
                        삭제
                      </a>   
                    @endcan
                                
                  </div>
              </article>

                  {{-- 답글 폼 --}}
                
                  <div data-reply ="{{ $comments->id }}" class="updatediv">
                    <input type="hidden" value="{{ $read[0]->id }}" id="hidden-postid">
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
                          <div class="comment-name-box">
                            
                            @if($reads->img == null)
                            <img src="{{URL::asset('/image/img.JPG')}}" alt="...">
                            @else
                            <img src="{{URL::asset('/image/'.$replys->img)}}" alt="...">
                            @endif  
                            
                            <span>{{ $replys->reply_writer }}</span>
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
              
                     
                          <div class="reviewupdelBtn" id="replyBtns">
                            @can('edit-post', $replys)
                            <a href="#"class="replyUpdateBtn" data-replyupdate="{{ $replys->id }}">수정</a>
                            <a href="#" class="replyDelBtn" data-replydel="{{ $replys->id }}" data-toggle="modal" data-target="#replyDelModal">
                              삭제
                            </a>  
                            @endcan             
                          </div>


                          {{-- 답글 수정 폼 --}}

                          <div data-replyupdateform ="{{ $replys->id }}" class="updatediv">
                          </div>

                          {{-- 답글 수정 폼 끝 --}}
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
                      
                      <input type="hidden" name="postid" value="{{ $read[0]->id }}">
                  </form>
          </div>
       
        </div>
      </footer>
        
    <?php $post = $read[0]?>   
    <div id="read-foot-1">
      <div id="read-updataDeleteBtn">
        @can('edit-post', $post)
        <div id="read-updataDeleteBtn-update">    
        <a href="/edit/{{ $post->id }}">수정</a>
        </div>      
        <form action="/destroy/{{ $post->id }}" method="post">
        @csrf
        <div id="read-updataDeleteBtn-delete">
          <button type="submit">삭제</button>
        </div>
        </form> 
        @endcan   
      </div>
      <div id="read-return">
        <div><a href="javascript:history.back();">목록</a></div>
      </div>
    </div>
  </article>   
  </div>

@endsection







@section('subContent')

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
          <button type="button" class="btn btn-danger" id="commentDelModalBtn" data-postid="{{ $read[0]->id }}">삭제하기</button>
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
          <button type="button" class="btn btn-danger" id="replyDelModalBtn" data-postid="{{ $read[0]->id }}">삭제하기</button>
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
        <img src="{{URL::asset('/image/'.$reads->img)}}">
      </div>
      <div class="mobile-read-top-item">
        <div class="mobile-read-name">{{ $reads->name }}</div>
        <div class="mobile-read-datenhit">
          <span>{{ $reads->time }}</span>
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

  <div class="mobile-comment-reply-read">
    @foreach ($comment as $cmt )
    <article class="mobile-comment-read">
    <div class="mobile-comment-info">

      <div class="mobile-comment-info-img">
        <img src="{{URL::asset('/image/'.$cmt->img)}}" alt="...">
      </div>

      <div class="mobile-comment-info-namedate">
        <span class="mobile-comment-info-name">{{ $cmt->comment_writer }}</span>
        <span class="mobile-comment-info-date">{{ $cmt->created_at }}</span>
      </div>

    </div>

    <div class="mobile-comment-content">
      {!! $cmt->comment_content !!}
    </div>

    <div id="commentBtns" class="mobile-commentBtn">     
      @can('edit-post', $cmt)        
        <a href="#" class="commentDelBtn" data-commentdel="{{ $cmt->id }}" data-toggle="modal" data-target="#commentDelModal">
          삭제
        </a>   
      @endcan
                  
    </div>
    
    
  </article>


  {{-- ㅡㅡㅡ모바일 답글ㅡㅡㅡ --}}
  <article class="mobile-reply-read">
    @foreach ($reply as $rpy )
    @if($rpy->comment_id == $cmt->id)
    <div class="mobile-comment-info">

      <div class="mobile-comment-info-img">
        <img src="{{URL::asset('/image/'.$rpy->img)}}" alt="...">
      </div>

      <div class="mobile-comment-info-namedate">
        <span class="mobile-comment-info-name">{{ $rpy->reply_writer }}</span>
        <span class="mobile-comment-info-date">{{ $rpy->created_at }}</span>
      </div>

    </div>

    <div class="mobile-comment-content">
      {!! $rpy->reply_content !!}
    </div>

    <div class="reviewupdelBtn" id="replyBtns">
      @can('edit-post', $replys)
      <a href="#" class="replyDelBtn" data-replydel="{{ $replys->id }}" data-toggle="modal" data-target="#replyDelModal">
        삭제
      </a>  
      @endcan             
    </div>
    @endif
    @endforeach
    
    
  </article>
  
  @endforeach

  {{-- ㅡㅡㅡㅡ답글 끝 ㅡㅡㅡㅡ --}}
  </div>

    <div>  
        <form action="/commentcreate" method="post" id="mobileform" enctype="multipart/form-data">
            @csrf
              <div class="review">
                                   
                    <textarea class="form-control" id="editor2" name="reply_content" ></textarea>
                    
                    <script>
                    $( document ).ready( function() {
                      $( 'textarea#editor2' ).ckeditor();
                  } );
                  </script>
                
                  <input type="hidden" class="mobileckeditorval" name="comment_content">
                  <input type="hidden" name="replycode" value="0">
                  <div class="commentitem">
                    <div class="filebox"> 
      
                      <a href="javascript:" onclick="mobileFileUploadAction();" class="my_button"><i class="fas fa-camera"></i> 사진첨부</a>
                  <input type="file" id="mobile_input_imgs" name="comment_photo[]"multiple/>
                    </div>
                    <div>
      
                    <button class="mobileCommentBtn" type="submit">등록</button>
                    </div>
                 </div>
                 <div class="imgs_wrap">
                  
                </div>
                
                <input type="hidden" name="postid" value="{{ $read[0]->id }}">
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
@endsection