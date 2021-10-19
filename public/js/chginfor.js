
var id = document.querySelector('#id');

var pw1 = document.querySelector('#pswd1');
var pwMsg = document.querySelector('#alertTxt');
var pwImg1 = document.querySelector('#pswd1_img1');


var userName = document.querySelector('#name');

var gender = document.querySelector('#gender');

var email = document.querySelector('#email');


var error = document.querySelectorAll('.error_next_box');


id.addEventListener("focusout", checkId);

userName.addEventListener("focusout", checkName);

email.addEventListener("focusout", isEmailCorrect);


function checkId() {
    var userid = id.value;
    var check = 0;
    var idPattern = /[a-zA-Z0-9_-]{5,20}/;
    $.ajax({
        url:'/checkid/chginfor',
        method:'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            userid:userid
        }
    }).done(function(result){
        if(id.value === "") {
            error[0].innerHTML = "필수 정보입니다.";
            error[0].style.color ="#FF0000";
            error[0].style.display = "block";
        } else if(!idPattern.test(id.value)) {
            error[0].innerHTML = "5~20자의 영문 소문자, 숫자와 특수기호(_),(-)만 사용 가능합니다.";
            error[0].style.color ="#FF0000";
            error[0].style.display = "block";
        } else if(result >= 1){
            error[0].innerHTML = "중복된 아이디입니다.";
            error[0].style.color ="#FF0000";
            error[0].style.display = "block";
        }else {
            error[0].innerHTML = "사용 가능한 아이디입니다.";
            error[0].style.color = "#000000";
            error[0].style.display = "block";
        }
    });

   
}


function checkName() {
    var namePattern = /[a-zA-Z가-힣]/;
    var username = userName.value;

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:'/checkname',
        data:{username:username},
        method:'post'

    }).done(function(result){

        if(userName.value === "") {
            error[1].innerHTML = "필수 정보입니다.";
            error[1].style.display = "block";
        } else if(!namePattern.test(userName.value) || userName.value.indexOf(" ") > -1) {
            error[1].innerHTML = "한글과 영문 대 소문자를 사용하세요. (특수기호, 공백 사용 불가)";
            error[1].style.display = "block";
        } else if(result >= 1){
            error[1].innerHTML = "중복된 닉네임입니다.";
            error[1].style.display = "block";
        } else {
            error[1].innerHTML = "사용 가능한 닉네임입니다.";
            error[1].style.color = "#000000";
            error[1].style.display = "block";
        }
       

    })
   
}




function isEmailCorrect() {
    var emailPattern = /[a-z0-9]{2,}@[a-z0-9-]{2,}\.[a-z0-9]{2,}/;

    if(email.value === ""){ 
        error[2].style.display = "none"; 
    } else if(!emailPattern.test(email.value)) {
        error[2].style.display = "block";
    } else {
        error[2].style.display = "none"; 
    }

}











