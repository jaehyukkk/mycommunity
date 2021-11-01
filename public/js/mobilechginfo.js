$(function(){

    
    
   

    var idCheck = $('#id-check');
    var nameCheck = $('#name-check');
    var emailCheck = $('#email-check');

    idCheck.on('click',function(e){

        var userid = $('.chg-id').val();

        e.preventDefault();

        $.ajax({
            url:'/chgCheckId',
            method:'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                userid:userid
            }
        }).done(function(data){
            if(data >= 1){
                alert('중복된 아이디입니다.');
            }
            else{
                alert('사용가능한 아이디입니다.');
            }
        });
    });

    nameCheck.on('click',function(e){

        var username = $('.chg-name').val();

        e.preventDefault();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/chgCheckName',
            data:{username:username},
            method:'post'
        }).done(function(data){
            if(data >= 1){
                alert('중복된 닉네임입니다.');
            }
            else{
                alert('사용가능한 닉네임입니다.');
            }
        });
    });

    emailCheck.on('click',function(e){
        e.preventDefault();

        var email = $('.chg-email').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/chgCheckEmail',
            data:{email:email},
            method:'post'
        }).done(function(data){
            if(data >= 1){
                alert('중복된 이메일입니다.');
            }
            else{
                alert('사용가능한 이메일입니다.');
            }
        })
    })


})