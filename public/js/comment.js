var commentUpdateSetting = {
    height : 150,
    minHeight : null,
    maxHeight : null,
    focus : true,
    lang : 'ko-KR',
    toolbar:false,
    callbacks: {
        onEnter: function(){
            box.summernote('insertNode', document.createTextNode("<br>")); 
            console.log('uiwdbvuwecbweuiuinsjk');
        }
    }
 };
 var commentReplySetting = {
    height : 150,
    minHeight : null,
    maxHeight : null,
    focus : true,
    lang : 'ko-KR',
    toolbar:false,
    placeholder: '답글을 작성해주세요',
    callbacks: {
        onEnter: function(){
            box.summernote('insertNode', document.createTextNode("<br>")); 
            console.log('uiwdbvuwecbweuiuinsjk');
        }
    }
 };

// 수정 폼 생성
$(document).on('click','.commentUpdateBtn',function(e){
    e.preventDefault();
    var html = "";
    var getId = $(this).data('update');

    var div = $("div[data-updateform='"+getId+"']");

    $(div).children().remove();
    $('.updatediv').children().remove();
    html += "<form action='/updatecomment' method='post' id='updateForm' enctype='multipart/form-data'>";
    html += "<textarea class='updatecomment' name='comment_content'></textarea>";
    html += "<div class='commentitem'>";
    html += "<div class='filebox'>";
    html += "<a href='javascript:' onclick='";
    html += "updataFileUploadAction();'";
    html += "class='my_button'><i class='fas fa-camera'></i> 사진첨부</a>";
    html += "<input type='file' id='input_img' name='comment_photo[]'multiple/>";
    html += "<input type='hidden' value='"+getId+"' name='commentid' class='commentid'>";
    html += "</div>";
    html += "<div class='updatedelBtn'>";
    html += "<button class='commentUpdateCancel'type='button'><i class='fas fa-times' id='cancelIcon'></i> 취소</button>";
    html += "<button class='commentUpdateResult' id='commentUpdateResult' type='submit'>수정</button>";
    html += "</div>";
    html += "</div>";
    html += "<div class='reviewImgsWrap'>";                 
    html += "</div>";
    html += "</form>";
    $(div).append(html);

    var text = $("input[data-update='"+getId+"']").val();
    $('.updatecomment').val(text);

     $('.updatecomment').summernote(commentUpdateSetting);
     $("#input_img").on("change", handleImgFile);
   
});

//리플 폼 생성(답글)
$(document).on('click','.commentReplyBtn',function(e){

    e.preventDefault();
    var html = "";
    var getId = $(this).data('reply');
    var postId = $('#hidden-postid').val();

    var div = $("div[data-reply='"+getId+"']");

    $(div).children().remove();
    $('.updatediv').children().remove();
    html += "<form action='/replycreate' method='post' id='replyForm' enctype='multipart/form-data'>";
    html += "<textarea class='updatecomment' name='reply_content'></textarea>";
    html += "<div class='commentitem'>";
    html += "<div class='filebox'>";
    html += "<a href='javascript:' onclick='";
    html += "replyFileUploadAction();'";
    html += "class='my_button'><i class='fas fa-camera'></i> 사진첨부</a>";
    html += "<input type='file' id='reply_input_img' name='reply_photo[]'multiple/>";
    html += "<input type='hidden' value='"+getId+"' name='commentid' class='commentid'>";
    html += "<input type='hidden' value='"+postId+"' name='post_id'>";
    html += "</div>";
    html += "<div class='updatedelBtn'>";
    html += "<button class='commentUpdateCancel'type='button'><i class='fas fa-times' id='cancelIcon'></i> 취소</button>";
    html += "<button class='replyResult' type='submit'>수정</button>";
    html += "</div>";
    html += "</div>";
    html += "<div class='reviewImgsWrap'>";                 
    html += "</div>";
    html += "</form>";
    $(div).append(html);

     $('.updatecomment').summernote(commentReplySetting);
     $("#reply_input_img").on("change", replyhandleImgFile);
   
});

//리플 업데이트 폼 생성(답글)

$(document).on('click','.replyUpdateBtn',function(e){

    e.preventDefault();
    var html = "";
    var getId = $(this).data('replyupdate');
    var replyid = $('.replyid').val();

    var div = $("div[data-replyupdateform='"+getId+"']");

    $(div).children().remove();
    $('.updatediv').children().remove();
    html += "<form action='/updatereply' method='post' id='replyupdateForm' enctype='multipart/form-data'>";
    html += "<textarea class='updatecomment' name='reply_content'></textarea>";
    html += "<div class='commentitem'>";
    html += "<div class='filebox'>";
    html += "<a href='javascript:' onclick='";
    html += "replyFileUploadAction();'";
    html += "class='my_button'><i class='fas fa-camera'></i> 사진첨부</a>";
    html += "<input type='file' id='reply_input_img' name='replyupdate_photo[]'multiple/>";
    html += "<input type='hidden' value='"+getId+"' name='replyid'>";
    html += "</div>";
    html += "<div class='updatedelBtn'>";
    html += "<button class='commentUpdateCancel'type='button'><i class='fas fa-times' id='cancelIcon'></i> 취소</button>";
    html += "<button class='replyUpdateResult' type='submit'>수정</button>";
    html += "</div>";
    html += "</div>";
    html += "<div class='reviewImgsWrap'>";                 
    html += "</div>";
    html += "</form>";
    div.append(html);

    var text = $("input[data-replyupdate='"+getId+"']").val();
    $('.updatecomment').val(text);

     $('.updatecomment').summernote(commentUpdateSetting);
     $("#reply_input_img").on("change", replyhandleImgFile);
})

$(document).on('click','.commentUpdateCancel',function(){
    $('.updatediv').children().remove();
});

$(document).on('click','.replyCancel',function(){
    var getId = $(this).data('reply');

    $("div[data-reply='"+getId+"']").css('display','none');
});

$(document).on('click','.replyUpdateCancel',function(){
    var getId = $(this).data('replyupdate');
    $("div[data-replyupdate='"+getId+"']").css('display','none');
});

        var sel_files = [];
        $(document).ready(function() {

            $("#input_imgs").on("change", handleImgFileSelect);
        });

        function fileUploadAction() {
            console.log("fileUploadAction");
            $("#input_imgs").trigger('click');
        }

        function handleImgFileSelect(e) {

            // 이미지 정보들을 초기화
            sel_files = [];
            $(".imgs_wrap").empty();

            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            var index = 0;
            filesArr.forEach(function(f) {
                if(!f.type.match("image.*")) {
                    alert("확장자는 이미지 확장자만 가능합니다.");
                    return;
                }

                sel_files.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                    var html = "<a href=\"javascript:void(0);\" onclick=\"deleteImageAction("+index+")\" id=\"img_id_"+index+"\"><img src=\"" + e.target.result + "\" data-file='"+f.name+"' class='selProductFile'></a>";
                    $(".imgs_wrap").append(html);
                    index++;

                }
                reader.readAsDataURL(f);

            });
        }


        $('.reviewBtn').on('click',function(e){

            e.preventDefault();
            var ContentFromEditor = CKEDITOR.instances.editor1.getData();

            var dataString = $("#Form").serialize();
                dataString += ContentFromEditor;

            $('.ckeditorval').val(dataString);

             var url = $('#form').attr('action');
             var form = $('#form')[0];
             var formData = new FormData(form);

             $.ajax({
                url:url,
                data:formData,
                enctype: 'multipart/form-data',
                type:'post',
                success:function(data){
                    if(data == 1){
                    history.go(0);
                    }
                    else if(data == 2){
                        alert('로그인을 해주세요.');
                    }
                    else{
                        alert('내용을 입력해주세요.');
                    }
                   
                },
                error: function(data){
                    console.log(data);
                },
                cache: false,
                contentType:false,
                processData:false
             });


        });





//댓글 삭제
 $(document).on('click','.commentDelBtn',function(e){
     e.preventDefault();
    var id = $(this).data('commentdel');
    $('#commentDelModalBtn').data('commentdel',id);
  })

  $(document).on('click','#commentDelModalBtn',function(){
    var id = $(this).data('commentdel');
    var postid = $(this).data('postid');

        $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/delcomment',
        data:{
            id:id,
            postid:postid
        },
        method:'post',
        success:function(){
            history.go(0);
        }
    })
  
  });


  $(document).on('click','.replyDelBtn',function(e){
    e.preventDefault();
   var id = $(this).data('replydel');
   $('#replyDelModalBtn').data('replydel',id);
 });


 $(document).on('click','#replyDelModalBtn',function(){
    var id = $(this).data('replydel');
    var postid = $(this).data('postid');

        $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/delreply',
        data:{
            id:id,
            postid:postid
        },
        method:'post',
        success:function(data){
            history.go(0);
        }
    })
  
  });

//댓글 삭제 끝 -----------------



  //----------------코멘트 수정--------------------

  var sel_files = [];
// $(document).ready(function() {
   
//     $("#input_img").on("change", handleImgFile);
// }); 

function updataFileUploadAction() {
    console.log("fileUploadAction");
    $("#input_img").trigger('click');
}

function handleImgFile(e) {
    // 이미지 정보들을 초기화
  
    sel_files = [];
    $(".imgs_wrap").empty();

    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);

    var index = 0;
    filesArr.forEach(function(f) {
        if(!f.type.match("image.*")) {
            alert("확장자는 이미지 확장자만 가능합니다.");
            return;
        }
        
        sel_files.push(f);

        var reader = new FileReader();
        reader.onload = function(e) {
            var html = "<a href=\"javascript:void(0);\" onclick=\"deleteImageAction("+index+")\" id=\"img_id_"+index+"\"><img src=\"" + e.target.result + "\" data-file='"+f.name+"' class='selProductFile'></a>";
            $('.reviewImgsWrap').append(html);
            index++;

        }
        reader.readAsDataURL(f);
        
    });
    // $('body').css('backgroundColor','black');
}




$(document).on('click','.commentUpdateResult',function(e){
    

    e.preventDefault();
    
     var url = $('#updateForm').attr('action');
     var form = $('#updateForm')[0];
     var formData = new FormData(form);

     $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
      
        url:url,
        data:formData,
        enctype: 'multipart/form-data',
        type:'post',
        success:function(data){
            history.go(0);
        },
        error: function(data){
            alert('실패');
        },
        cache: false,
        contentType:false,
        processData:false
     });
    
    
})

//코멘트 수정 끝 ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ


//답글 관련

$(document).on('click','.replyResult', function(e){

    e.preventDefault();

    var comment = $('.updatecomment').val();
    if(comment.length == 0){
        alert('내용을 입력해주세요.');
        return false;
    }

     var url = $('#replyForm').attr('action');
     var form = $('#replyForm')[0];
     var formData = new FormData(form);
    
     $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:url,
        data:formData,
        enctype: 'multipart/form-data',
        type:'post',
        success:function(data){
            if(data == 1){
                history.go(0);
                }
                else if(data == 2){
                    alert('로그인을 해주세요.');
                }
            },
            error: function(e){
                console.log(e);
            }, 
             
        cache: false,
        contentType:false,
        processData:false
     });
    
    
});




var reply_files = [];
$(document).ready(function() {
   
    $("#reply_input_img").on("change", replyhandleImgFile);
}); 

function replyFileUploadAction() {
    console.log("fileUploadAction");
    $("#reply_input_img").trigger('click');
}

function replyhandleImgFile(e) {

    // 이미지 정보들을 초기화
    reply_files = [];
    $(".reviewImgsWrap").empty();

    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);

    var index = 0;
    filesArr.forEach(function(f) {
        if(!f.type.match("image.*")) {
            alert("확장자는 이미지 확장자만 가능합니다.");
            return;
        }

        reply_files.push(f);

        var reader = new FileReader();
        reader.onload = function(e) {
            var html = "<a href=\"javascript:void(0);\" onclick=\"deleteImageAction("+index+")\" id=\"img_id_"+index+"\"><img src=\"" + e.target.result + "\" data-file='"+f.name+"' class='selProductFile'></a>";
            $(".reviewImgsWrap").append(html);
            index++;

        }
        reader.readAsDataURL(f);
        
    });
}

//답글관련 끝 ㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡㅡ

//답글 수정
$(document).on('click','.replyUpdateResult',function(e){

    e.preventDefault();
  
     var url = $('#replyupdateForm').attr('action');
     var form = $('#replyupdateForm')[0];
     var formData = new FormData(form);
    
     $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:url,
        data:formData,
        enctype: 'multipart/form-data',
        type:'post',
        success:function(data){
            if(data == 'success'){
                history.go(0); 
            }
            else{
                console.log(data);
                alert('실패');
            }
            
           
        },
        error: function(data){
            console.log(data);
            alert('실패');
        },
        cache: false,
        contentType:false,
        processData:false
     });
    
    
});




var replyUpdate_files = [];
$(document).ready(function() {
   
    $("#replyUpdate_input_img").on("change", replyUpdateHandleImgFile);
}); 

function replyUpdateFileUploadAction() {
    $("#replyUpdate_input_img").trigger('click');
}

function replyUpdateHandleImgFile(e) {

    // 이미지 정보들을 초기화
    replyUpdate_files = [];
    $(".replyUpdateImgsWrap").empty();

    var files = e.target.files;
    var filesArr = Array.prototype.slice.call(files);

    var index = 0;
    filesArr.forEach(function(f) {
        if(!f.type.match("image.*")) {
            alert("확장자는 이미지 확장자만 가능합니다.");
            return;
        }

        replyUpdate_files.push(f);

        var reader = new FileReader();
        reader.onload = function(e) {
            var html = "<a href=\"javascript:void(0);\" onclick=\"deleteImageAction("+index+")\" id=\"img_id_"+index+"\"><img src=\"" + e.target.result + "\" data-file='"+f.name+"' class='selProductFile'></a>";
            $(".replyUpdateImgsWrap").append(html);
            index++;

        }
        reader.readAsDataURL(f);
        
    });
}