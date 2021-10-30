$(function(){
    $('#id-check').on('click',function(e){
        e.preventDefault();

        var userid = $('.join-id').val();
        if(userid.length == 0){
            alert('아이디를 작성해주세요.');
            return false;
        }

        $.ajax({
            url:'/api/checkid',
            method:'post',
            data:{
                userid:userid
            },
        }).done(function(data){
            if(data >= 1){
                alert('중복된 아이디입니다.');
            }
            else{
                alert('사용 가능한 아이디입니다.');
            }
        })
    })
});

$(function(){
    $('#name-check').on('click',function(e){
        e.preventDefault()
        var username = $('.join-name').val();
        if(username.length == 0){
            alert('닉네임은 최소 두글자 이상이여야 합니다.');
            return false;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/joincheckname',
            data:{username:username},
            method:'post'
        }).done(function(data){
            if(data >= 1){
                alert('중복된 닉네임입니다.');
            }
            else{
                alert('사용 가능한 닉네임입니다.');
            }
        })
    })
})

$(function(){
    $('#email-check').on('click',function(e){
        e.preventDefault()
        var email = $('.join-email').val();
        if(email.length == 0){
            alert('이메일을 작성해주세요.');
            return false;
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/joincheckemail',
            data:{email:email},
            method:'post'
        }).done(function(data){
            if(data >= 1){
                alert('중복된 이메일입니다.');
            }
            else{
                alert('사용 가능한 이메일입니다.');
            }
        })
    })
})


