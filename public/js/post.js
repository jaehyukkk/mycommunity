
$(function(){

    $('.subboard span a').each(function() {
    const pathname = (window.location.pathname.match(/[^\/]+$/)[0]);
    const set = $(this).attr('href');
    const cut = set.split('/');
    const url = cut[3];

    console.log((window.location.pathname.match(/[^\/]+$/)[0]));

    if (cut[3] == pathname)
    {   
         $(this).addClass('current');
    }

    });
 });

 function postRemoveCheck(e) {

     if (confirm("해당 게시글을 정말 삭제하시겠습니까 ?") === true){ 
         $('#postDeleteForm').submit();
     }else{  
         return false;
     }   
 }










   
    
 