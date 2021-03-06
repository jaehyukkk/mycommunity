@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/css.css?v=').time() }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/board/board.css?v=').time() }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/board/comment.css?v=').time() }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/summernote/summernote-lite.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ URL::asset('/summernote/css.css') }}" >
@endsection

@section('script')
<script  src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('/summernote/summernote-lite.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('/summernote/js.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('js/comment.js?v=').time() }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('js/post.js?v=').time()}}" defer></script>
<script type="text/javascript" src="{{ URL::asset('/ckeditor_review/ckeditor/ckeditor.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('/ckeditor_review/ckeditor/adapters/jquery.js') }}" defer></script>
<script type="text/javascript" src="{{ URL::asset('js/time.js?v=').time() }}" defer></script>
@endsection
@section('content')
<article class="read-main">
  <div class="read-baord-box">
      @foreach ($read as $reads )  

      <article class="read">  
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
                    <span>?????????<span class="read-num">{{ $reads->hit }}</span></span>
                    <span>??????<span class="read-num">{{ $commentCount }}</span></span>
                </div>       
            </div>

            <div class="board-content">
                {!! $reads->description !!}
            </div>
      </article>

      <div class="mobile-read">
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
                <span>?????? {{ $reads->hit }}</span>
              </div>
            </div>
          </div>
        </div>
      
        <div class="mobile-read-description">
          {!! $reads->description !!}
        </div>
      </div>
    @endforeach
    

          <div class="comment-title">
            <i class="far fa-comment-dots"></i> 
            <span class="comment-title-title">??????</span>
            <span class="comment-title-count">{{ $commentCount }}</span>
          </div>

      
           <div class="comment-box"> 
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
                  <div>
                    <a href="#"class="commentReplyBtn" data-reply="{{ $comments->id }}">??????</a>
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
                      <a href="#"class="commentUpdateBtn" data-update="{{ $comments->id }}">??????</a>
                      <a href="#" class="commentDelBtn" data-commentdel="{{ $comments->id }}" data-toggle="modal" data-target="#commentDelModal">
                        ??????
                      </a>   
                    @endcan
                                
                  </div>
              </article>

                  {{-- ?????? ??? --}}
                
                  <div data-reply ="{{ $comments->id }}" class="updatediv">
                    <input type="hidden" value="{{ $read[0]->id }}" id="hidden-postid">
                  </div>
                    {{-- ?????? ??? ??? --}}

                  
                  {{-- ?????? ?????? ??? --}}
                  
                  <div data-updateform ="{{ $comments->id }}" class="updatediv">
                  </div>
                  
                  {{-- ?????? ?????? ??? ??? --}}


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
                            <a href="#"class="replyUpdateBtn" data-replyupdate="{{ $replys->id }}">??????</a>
                            <a href="#" class="replyDelBtn" data-replydel="{{ $replys->id }}" data-toggle="modal" data-target="#replyDelModal">
                              ??????
                            </a>  
                            @endcan             
                          </div>


                          {{-- ?????? ?????? ??? --}}

                          <div data-replyupdateform ="{{ $replys->id }}" class="updatediv">
                          </div>

                          {{-- ?????? ?????? ??? ??? --}}
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
                    <div class="comment">
                                         
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
            
                            <a href="javascript:" onclick="fileUploadAction();" class="my_button"><i class="fas fa-camera"></i> ??????</a>
                        <input type="file" id="input_imgs" name="comment_photo[]" accept="image/*" multiple/>
                          </div>
                          <div>
            
                          <button class="reviewBtn" type="submit">??????</button>
                          </div>
                       </div>
                       <div class="imgs_wrap">
                        
                      </div>
                      
                      <input type="hidden" name="postid" value="{{ $read[0]->id }}">
                  
                </div>
              </form>
        </div>
      </div>
        
    <?php $post = $read[0]?>   
    <div id="read-foot-1">
      <div id="read-updataDeleteBtn">
        @can('edit-post', $post)
        <div id="read-updataDeleteBtn-update">    
        <a href="/edit/{{ $post->id }}">??????</a>
        </div>      
        <form action="/destroy/{{$post->id}}" method="post" id="postDeleteForm">
        @csrf
        </form>
        <div id="read-updataDeleteBtn-delete">
          <button onclick="postRemoveCheck()">??????</button>
        </div> 
        @endcan   
      </div>
      <div id="read-return">
        <div><a href="javascript:history.back();">??????</a></div>
      </div>
    </div>
  </article>   
  

  <div class="modal fade" id="commentDelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">????????? ??????</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ????????? ?????? ?????????????????????????
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="commentDelModalBtn" data-postid="{{ $read[0]->id }}">????????????</button>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">????????????</button>
        </div>
      </div>
    </div>
  </div>
  
  
  <div class="modal fade" id="replyDelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">????????? ??????</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ????????? ?????? ?????????????????????????
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" id="replyDelModalBtn" data-postid="{{ $read[0]->id }}">????????????</button>
             <button type="button" class="btn btn-secondary" data-dismiss="modal">????????????</button>
        </div>
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










