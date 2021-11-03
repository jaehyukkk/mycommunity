$(function(){
    let today = new Date();   

    let Y = today.getFullYear(); // 년도
    let M = today.getMonth() + 1;  // 월
    let D = today.getDate();  // 날짜

    let ymd = Y + '-' + M + '-' + D;

     var cnt = $('.time').length;
     for(var i =0 ; i < cnt; i++){
         var times = $('.time').eq(i).text().substring(0,10);
         if(times == ymd){         
            $('.time').eq(i).text($('.time').eq(i).text().substring(10,16));
         }
         else{
            $('.time').eq(i).text(times);
         }
       
     }
    
  
 })


$(function(){
    $('.lb-minipage-result').on('click',function(){
        var value = $('.lb-minipage-input').val();

        if(value.length < 2){
            alert('닉네임을 2글자 이상 입력해주세요.');
            return false;
        }

        var popup = window.open("https://lovebeat.plaync.com/board/character/characterlist?nickname="+value+"&page=1","new","width=500,height=800");

        return popup;

    });
});


$(function(){
    $('.lb-minipage-input').keydown(function(key){
        if(key.keyCode == 13){
            $('.lb-minipage-result').click();
        }
    })
})
