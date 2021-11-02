// 툴바생략

$(document).ready(function(){
    var toolbar = [
        // 글꼴 설정
        ['fontname', ['fontname']],
        // 글자 크기 설정
        ['fontsize', ['fontsize']],
        // 굵기, 기울임꼴, 밑줄,취소 선, 서식지우기
        ['style', ['bold', 'italic', 'underline','strikethrough', 'clear']],
        // 글자색
        ['color', ['forecolor','color']],
        // 표만들기
        ['table', ['table']],
        // 글머리 기호, 번호매기기, 문단정렬
        ['para', ['ul', 'ol', 'paragraph']],
        // 줄간격
        ['height', ['height']],
        // 그림첨부, 링크만들기, 동영상첨부
        ['insert',['picture','link','video']],
        // 코드보기, 확대해서보기, 도움말
        ['view', ['codeview','fullscreen', 'help']]
      ];

var setting = {
    height : 600,
    minHeight : null,
    maxHeight : null,
    focus : true,
    lang : 'ko-KR',
    toolbar : toolbar,
    //콜백 함수
    callbacks : { 
        onImageUpload : function(files, editor, welEditable) {
    
        for (var i = files.length - 1; i >= 0; i--) {
        uploadSummernoteImageFile(files[i],
        this);
            }

        },

        onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            bufferText = bufferText.replace(/\r?\n/g, '<br>');
            document.execCommand('insertHtml', false, bufferText);
          }
    }

 };
$('#summernote').summernote(setting);




 
var commentUpdateSetting = {
    height : 200,
    minHeight : null,
    maxHeight : null,
    focus : true,
    lang : 'ko-KR',
    toolbar:false,
 };

 $('.updatecomment').summernote(commentUpdateSetting);

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

$("#summernote").on("summernote.enter", function(we, e) {
    $(this).summernote("pasteHTML", "<br><br>");
    e.preventDefault();
});





