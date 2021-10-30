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

//  $(document).ready(function(){
 
//     $('.menu_btn>a').on('click', function(){
//         $('.menu_bg').show(); 
//         $('.sidebar_menu').show().animate({
//             right:0
//         });  
//     });
//     $('.close_btn>a').on('click', function(){
//         $('.menu_bg').hide(); 
//         $('.sidebar_menu').animate({
//             right: '-' + 70 + '%'
//                    },function(){
// $('.sidebar_menu').hide(); 
// }); 
//     });

// });

