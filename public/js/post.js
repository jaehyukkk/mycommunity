$(document).ready(function(){
    var id = $('#container-title').data('id');

    $.ajax({
        url:'/api/getcategorytitle',
        method:'get',
        data:{id:id},
        success:function(data){
            var title = data[0].subcategoryname;
            $('#container-title').text(title);
        }
    })
});

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


  
    // $(function(){
    //     var id = $('#maincategoryId').val();
    //     var subid = $('#subcategoryId').val();

    //     $.ajax({
    //         url:'/api/getnotice',
    //         method:'get',
    //         data:{id:id,subid:subid},
    //         success:function(data){   
    //               var html = $('#board-content');
    //               var str="";
    //           $.each(data,function(i){
    //               str += '<tr>';
    //               str += '<th scope="row" class="bno">공지</th>';
    //               str += '<td class="Title">'+data[i].title+'</td>';
    //               str += '<td>'+data[i].time+'</td>';
    //               str += '<td>'+data[i].name+'</td>';
    //               str += '<td>'+data[i].hit+'</td>';
    //               str += '</tr>'; 
    //           });
    //           html.prepend(str);
    //         }
    //       });
    // })
   

   
    
 