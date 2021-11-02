
    $(document).ready(function() {
        $('#table_id').DataTable();
    } );

    $(function(){
        $('.maincategory').on('click',function(){
            var getId = $(this).data('id');
            var getPhotoCode = $(this).data('photocode');

            var div = $("div[data-id='"+getId+"']");

            chgBackground(div);
            chgValue(div,getId,getPhotoCode);

            $('#division').val('0');
            $('#maincategory_id').val(getId);
            
        })
    })

    $(function(){
        $('.subcategory').on('click',function(){
            var getId = $(this).data('subid');
            var getPhotoCode = $(this).data('photocode');

            var div = $("div[data-subid='"+getId+"']");

            chgBackground(div);
            chgValue(div,getId, getPhotoCode);
 
            $('#division').val('1');
            $('#maincategory_id').val("");
        })
    })

    function chgBackground(div){
        $('.maincategory').css('backgroundColor','white');
        $('.subcategory').css('backgroundColor','white');
        div.css('backgroundColor','#e1e1ff');
    }

    function chgValue(div,getId,getPhotoCode){
        $('#name').val(div.text());
        $('#categoryid').val(getId);
        $('#add-category-top').text('(수정)'+div.text()); 
        $('#addcategoryForm').attr('action','/updatecategory');
        $('#purpose').val(getPhotoCode).prop('selected',true);
    }
  

    $(function(){
        $('.addcategory-btn').on('click',function(){
            var division = $(this).data('division');
            $('#division').val(division); 
            $('#addcategoryForm').attr('action','/addcategory');

            if(division == 0){
                $('#add-category-top').text('(추가)상위게시판');
            }
            else{
                if($('#maincategory_id').val().length == 0){
                    alert('상위게시판을 선택해주세요.');
                    return false;
                }
                $('#add-category-top').text('(추가)하위게시판');
            }

            $('#name').val(""); 
            
              
        });
    });



    



    function removeCheck() {

        if (confirm("카테고리를 정말 삭제하시겠습니까 ?") == true){ 
            $('#addcategoryForm').attr('action','/delcategory');
            $('#addcategoryForm').submit();
        }else{  
            return false;
        }   
    }
    

    $('#addSubmit').on('click',function(){
        $('#addcategoryForm').submit();
    })

   $(function(){
       $('.deleteUser').on('click',function(){
        if (confirm("회원정보를 정말 삭제하시겠습니까 ?") == true){ 
            $('#userdeleteForm').submit();
        }else{  
            return false;
        } 

       })
   });

   $(function(){
       $('.deleteBtn').on('click',function(e){
            e.preventDefault();

            var chkArray = new Array();

            $('input[name="checkdid[]"]:checked').each(function(){
                var tmpVal = $(this).val();
                chkArray.push(tmpVal);
            });

            if(chkArray.length < 1){
                alert('게시물을 선택해주세요.');
                return;
            }

            if (confirm("해당 게시물을 정말 삭제하시겠습니까 ?") == true){ 
                $('#deleteForm').submit();
            }else{  
                return false;
            } 

       })
   });


   function allCheck(thisId){
    if($('#'+thisId).prop('checked')){
        $("input[type=checkbox]").prop("checked",true);
    }
    else{
        $("input[type=checkbox]").prop("checked",false);
    }
    
   }

   