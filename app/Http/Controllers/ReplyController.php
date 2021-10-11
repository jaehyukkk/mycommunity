<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\Noti;
use App\Models\Comment;
use App\Models\Post;
use Exception;
use Faker\Extension\Extension;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function create(Request $request){

        try{
        $file = [];

        $request->validate([
            'reply_content' => 'required'
        ]);
        

        $comment_content = $request->input('reply_content');
        $comment_id = $request->input('commentid');
        
        if(Auth::check()){
        
        if($request->hasfile('reply_photo')){
            foreach($request->file('reply_photo') as $photos){
               
                $name = time().rand(1,9999).'.'.$photos->extension();
                $photos->move(public_path('image'),$name);
                $file[] = $name;
              
            }
        }

        $post_id = $request->input('post_id');
        $noti_content = Comment::where('id',$comment_id)->get('comment_content');
        $user_id = Post::where('id',$post_id)->get('user_id');


        Reply::create([
            'reply_content' => $comment_content,
            'reply_writer'  => Auth::user()->name,
            'comment_id'         => $comment_id,
            'user_id'         => Auth::user()->id,
            'reply_photo'   => json_encode($file),
        ]);
        
        if(Auth::user()->id != $user_id[0]->user_id){
        Noti::create([
            'noti_content' => $noti_content[0]->comment_content,
            'post_id' => $post_id,
            'user_id' => $user_id[0]->user_id,
            'noti_code' => 2,
        ]);
        }

        return 1;
        }

        else{
            return 2;
        }

        return 3;
    }
    catch(Exception $e){
        return $e->getMessage();
    }

  
       
    }



    public function updataReply(Request $request){

        $file = [];

        $reply_content = $request->input('reply_content');
        $idx = $request->input('replyid');        

        if($request->hasfile('replyupdate_photo')){
            foreach($request->file('replyupdate_photo') as $photos){
               
                $name = time().rand(1,9999).'.'.$photos->extension();
                $photos->move(public_path('image'),$name);
                $file[] = $name;
              
            }
        }

        if($file != null){
            Reply::find($idx)->update([
            'reply_content' => $reply_content,
            'reply_photo'   => json_encode($file)
        ]);
        return 'success';
    }
        else{
            Reply::find($idx)->update([
                'reply_content' => $reply_content,
            ]);
            return 'success';
        }
       

    }

    public function delReply(Request $request){
        // return 'sadasd';
        $id = $request->input('id');
        Reply::where('id',$id)->delete();        
        return 'success';
    }
}
