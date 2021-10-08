

    <table class="mail_form" border="0"> 
        <tr> 
        <th>Subject</th> 
        <td>{{ $data_arr['subject'] }}</td> 
    </tr> 
    <tr> 
        <th>Name</th> 
        <td>{{ $data_arr['name'] }}</td> 
    </tr> 
    <tr> 
        <th>E-mail</th> 
        <td>{{ $data_arr['emailAddr'] }}</td> 
    </tr> 
    <tr> 
        <th>Content</th> 
        <td><?php echo nl2br($data_arr['content']); ?></td> 
    </tr> 
    </table>

