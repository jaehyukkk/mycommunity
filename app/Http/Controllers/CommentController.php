<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Reply;
use Exception;
use Faker\Extension\Extension;
use Illuminate\Support\Facades\Auth;



class CommentController extends Controller
{

    // public function __construct()
    // {
    // $this->middleware('auth');
    // }

    public function create(Request $request){
     
        try{
        $file = [];

        $request->validate([
            'comment_content' => 'required'
        ]);
   
        $comment_content = $request->input('comment_content');
        $post_id = $request->input('postid');
        $replycode = $request->input('replycode');

        if(Auth::check()){
        
        if($request->hasfile('comment_photo')){
            foreach($request->file('comment_photo') as $photos){
               
                $name = time().rand(1,9999).'.'.$photos->extension();
                $photos->move(public_path('image'),$name);
                $file[] = $name;
              
            }
        }
    
        Comment::create([
            'comment_content' => $comment_content,
            'comment_writer'  => Auth::user()->name,
            'post_id'         => $post_id,
            'user_id'         => Auth::user()->id,
            'comment_photo'   => json_encode($file),
            'replycode'       => $replycode
        ]);

        return 1;
        }

        else if(Auth::guest()){
            return 2;
        }
        return 3;
    }
    catch(Exception $e){
        return $e->getMessage();
    }

  
       
    }



    public function updataComment(Request $request){

        $file = [];

      
        $reply_content = $request->input('comment_content');
        $idx = $request->input('commentid');        

        if($request->hasfile('comment_photo')){
            foreach($request->file('comment_photo') as $photos){
               
                $name = time().rand(1,9999).'.'.$photos->extension();
                $photos->move(public_path('image'),$name);
                $file[] = $name;
              
            }
        }

        if($file != null){
        Comment::find($idx)->update([
            'comment_content' => $reply_content,
            'comment_photo'   => json_encode($file)
        ]);
        return 'success';
    }
        else{
            Comment::find($idx)->update([
                'comment_content' => $reply_content,
            ]);
            return 'success';
        }
       

    }

    public function delComment(Request $request){
        $id = $request->input('id');
        Comment::where('id',$id)->delete();
        Reply::where('comment_id',$id)->delete();        
        return 'success';
    }
}
