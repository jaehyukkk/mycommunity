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

