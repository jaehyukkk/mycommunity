<!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
 <head> 
     <meta charset="utf-8"> 
     <meta name="viewport" content="width=device-width, initial-scale=1"> 
     <meta name="csrf-token" content="{{ csrf_token() }}"> 
     <!-- Ajax CDN --> 
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
     <title>Laravel Mail Send</title> 
    </head> 
    <body > 
        <form onSubmit="return mailValidate(this)" > 
            <h3>E - Mail Address</h3> 
            <input type="email" name="emailAddr" id="emailAddr"> 
            <hr> 
            <h3>Name</h3> 
            <input type="text" name="name" id="name">
             <hr> 
             <h3>Subject</h3> 
             <input type="text" name="subject" id="subject">
              <hr> 
              <h3>Content</h3> 
              <textarea name="content" id="content"></textarea> 
              <hr> 
              <input type="submit" value="submit"> 
            </form> 
        </body> 
        <script> 
        function mailValidate(e){ 
            var emailAddr = e.children.emailAddr.value.trim(); 
            var name = e.children.name.value.trim(); 
            var subject = e.children.subject.value.trim(); 
            var content = e.children.content.value.trim(); 
            if(emailAddr.length <= 0){ 
                alert('Please Enter Your Email'); 
                return false; 
                } 
                if(name.length <= 0){
                     alert('Please Enter Your Name'); 
                     return false; 
                     } 
                     if(subject.length <= 0){ 
                         alert('Please Enter Subject'); 
                         return false; 
                         } 
                         if(content.length <= 0){ 
                             alert('Please Enter Content');
                              return false; 
                              } $.ajax({ 
                                  headers: 
                                  { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') }, 
                                  url: 'mailSendSubmit', 
                                  type:'POST', 
                                  data: { 
                                      'subject' : subject, 'content' : content, 'name' : name, 'emailAddr' : emailAddr 
                                      }, 
                                      success: function(data){ 
                                          e.children.emailAddr.value = ''; 
                                          e.children.name.value =''; 
                                          e.children.subject.value =''; 
                                          e.children.content.value =''; 
                                          alert('The mail has been sent successfully.'); 
                                          },
                                          error: function(e){ 
                                              console.log(e); 
                                              alert('The mail transfer failed.'); 
                                              } 
                                              }) 
                                              return false; 
                                              } 
         </script> 
</html>
