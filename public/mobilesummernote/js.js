// 툴바생략

$(document).ready(function(){



var mobiletoolbar = [
    // 그림첨부, 링크만들기, 동영상첨부
    ['insert',['picture','video']],
  ];

var mobileSetting = {
    height : 600,
    minHeight : null,
    maxHeight : null,
    focus : true,
    lang : 'ko-KR',
    toolbar:mobiletoolbar,
    callbacks : { 
        onImageUpload : function(files, editor, welEditable) {
    // 파일 업로드(다중업로드를 위해 반복문 사용)
        for (var i = files.length - 1; i >= 0; i--) {
        uploadSummernoteImageFile(files[i],
        this);
            }

        }
    }
 };

 $('#mobile-summernote').summernote(mobileSetting);
 

function uploadSummernoteImageFile(photo, el) {
    data = new FormData();
    data.append("photo", photo);
    $.ajax({
        data : data,
        type : "POST",
        url : "/api/imageupload",
        enctype : 'multipart/form-data',
        cache: false,
        contentType:false,
        processData:false,
        success : function(data) {
            $(el).summernote('editor.insertImage', data);

            
            
        }
    });
}
})

$("#mobile-summernote").on("summernote.enter", function(we, e) {
    $(this).summernote("pasteHTML", "<br><br>");
    e.preventDefault();
});


