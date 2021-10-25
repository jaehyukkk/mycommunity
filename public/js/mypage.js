$(function(){

   var cnt = $("span[name=notistitle]").length; 
   for(var i = 0; i < cnt ; i ++){
    var text = $("span[name=notistitle]").eq(i).text();
    if(text.length > 13){
        $("span[name=notistitle]").eq(i).text(
            $("span[name=notistitle]").eq(i).text().substring(0,13) + "..."
        );
    }
   }
});

$(function(){
    $('#deleteNotiBtn').on('click', function(e){
        e.preventDefault();

        var chkArray = new Array();

        $('input[name="delete[]"]:checked').each(function(){
            var tmpVal = $(this).val();
            chkArray.push(tmpVal);
        });

        if(chkArray.length < 1){
            alert('알림을 선택해주세요.');
            return;
        }

        if (confirm("해당 알림을 정말 삭제하시겠습니까 ?") == true){ 
            $('#deleteNotiForm').submit();
         }else{  
             return false;
         } 
    });
});


function allCheck(thisId){
    if($('#'+thisId).prop('checked')){
        $("input[type=checkbox]").prop("checked",true);
    }
    else{
        $("input[type=checkbox]").prop("checked",false);
    }
    
   }

// $(function(){
//     $('.deleteBtn').on('click',function(e){
//          e.preventDefault();

//          var chkArray = new Array();

//          $('input[name="checkdid[]"]:checked').each(function(){
//              var tmpVal = $(this).val();
//              chkArray.push(tmpVal);
//          });

//          if(chkArray.length < 1){
//              alert('게시물을 선택해주세요.');
//              return;
//          }

//          if (confirm("해당 게시물을 정말 삭제하시겠습니까 ?") == true){ 
//              $('#deleteForm').submit();
//          }else{  
//              return false;
//          } 

//     })
// });


$(document).ready(function(){

    
    $('#findidformBtn').on('click',function(e){ 
        e.preventDefault();

        var url = $('#findidform').attr('action');
        var form = $('#findidform');
        var formData = new FormData(form[0]);

        emailVali(url, formData);
        
     });

     $('#findpwformBtn').on('click',function(e){ 
        e.preventDefault();

        var url = $('#findpwform').attr('action');
        var form = $('#findpwform');
        var formData = new FormData(form[0]);

        var id = $('#id').val();

        if(id.length <= 0){
            alert('아이디를 입력해주세요.');
            return false;
        }

        emailVali(url, formData);
        
     });

        function emailVali(url, formData){
            var email = $('#email').val();
            var regExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
    
        if(email.length <= 0){ 
            alert('이메일을 입력해주세요.'); 
            return false; 
            } 
            if(email.match(regExp) == null){
                alert('이메일 형식이 잘못되었습니다.');
                return false;
            }

    
        finds(url, formData); 
        }

         function finds(url, formData){
            $('.notice').css('display','block');
            $.ajax({ 
                headers: 
                { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
                url: url, 
                type:'POST', 
                data: formData,
                processData: false,
                contentType: false,
    
                   success:function(data){
                    if(url == '/findIdSubmit'){                
                        findAlert(data);      
                    }
                    else{
                        findPwAlert(data);
                    }        
                   },
                        error: function(e){ 
                            console.log(e); 
                            alert('The mail transfer failed.'); 
                            } ,
                            
                            }) ;
         }

         function findAlert(data){

            $('.notice').css('display','none');
            if(data == 1){
                alert('이메일 발송이 완료되었습니다. \n해당 아이디로 로그인해주세요.');
            }
            else{
                console.log(data);
                alert('조회결과가 없습니다.');
            }
         }

         function findPwAlert(data){
            $('.notice').css('display','none');

            if(data == 1){
                alert('이메일 발송이 완료되었습니다. \n발송된 코드를 입력해주세요.');
                $("#authinput").attr("disabled", false);         
            }
            else{
                console.log(data);
                alert('조회결과가 없습니다.');
            }
         }
       
 });

 $(function(){
     $('#pwchgBtn').on('click',function(e){
         var password = $('#password').val();
         var repassword = $('#repassword').val();

         if(password != repassword){
            e.preventDefault();
            alert('비밀번호가 일치하지 않습니다.');
         }
     })
 })

 $(function(){
     $('#next').on('click',function(e){
         var value = $('#authinput').val();
         if(value.length <= 0){
             e.preventDefault();
             alert('인증번호를 입력해주세요.');
         }
     })
 });





