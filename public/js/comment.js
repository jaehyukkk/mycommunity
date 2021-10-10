$(document).on('click','.reviewUpdateBtn',function(e){
    e.preventDefault();

    var getId = $(this).data('update');
    var text = $("input[data-update='"+getId+"']").val();
    $("textarea[data-update='"+getId+"']").val(text);
    $("div[data-update='"+getId+"']").css('display','block');

})

$(document).on('click','.commentReplyBtn',function(e){
    e.preventDefault();
    var getId = $(this).data('reply');
    $("div[data-reply='"+getId+"']").css('display','block');
});

$(document).on('click','.replyUpdateBtn',function(e){
    e.preventDefault();
    var getId = $(this).data('replyupdate');
    var text = $("input[data-replyupdate='"+getId+"']").val();
    $("textarea[data-replyupdate='"+getId+"']").val(text);
    
    $("div[data-replyupdate='"+getId+"']").css('display','block');
})

$(document).on('click','.reviewUpdateCancel',function(){
    var getId = $(this).data('update');
    $("div[data-update='"+getId+"']").css('display','none');
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

        $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/delcomment',
        data:{
            id:id
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

        $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/delreply',
        data:{
            id:id
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
$(document).ready(function() {
   
    $("#input_img").on("change", handleImgFile);
}); 

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
            $(".reviewImgsWrap").append(html);
            index++;

        }
        reader.readAsDataURL(f);
        
    });
}




$('.reviewUpdateResult').on('click',function(e){

    e.preventDefault();
    var code = $(this).data('update');
  

  
     var url = $('#updateForm'+code+'').attr('action');
     var form = $('#updateForm'+code+'')[0];
     var formData = new FormData(form);

     $.ajax({
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

$('.replyBtn').on('click',function(e){

    e.preventDefault();
    var code = $(this).data('reply');
  
     var url = $('#replyForm'+code+'').attr('action');
     var form = $('#replyForm'+code+'')[0];
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
                    alert('내용을 입력해주세요');
                }
               
            },
            error: function(){
                alert('내용을 입력해주세요.');
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
$('.replyUpdateResult').on('click',function(e){

    e.preventDefault();
    var code = $(this).data('replyupdate');
  
     var url = $('#replyupdateForm'+code+'').attr('action');
     var form = $('#replyupdateForm'+code+'')[0];
     var formData = new FormData(form);
    
     $.ajax({
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