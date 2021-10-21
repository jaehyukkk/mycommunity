<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin.index');
    }

    public function post(){

        $board = Post::join('users', 'posts.user_id', '=', 'users.id')
        ->join('subcategories', 'posts.subcategory_id', '=', 'subcategories.id')
        ->select('*','posts.created_at as time','posts.id as idx','posts.maincategory_id as mainid')
        ->orderBy('posts.id','desc')
        ->get();  

        return view('admin.post',compact('board'));
    }

    public function users(){
        $user = User::get();
        return view('admin.users',compact('user'));
    }

    public function deleteUser(Request $request){

        $id = $request->id;
        User::find($id)->delete();
        return redirect()->back();
    }

    public function deleteFunction(Request $request){
        
        $id = $request->checkdid;
        $this->deleteResult($id);

        return redirect()->back();
    }

    public function deleteResult(array $id){

            Post::whereIn('id',$id)->delete();

            $comment = Comment::whereIn('post_id',$id);
            $commentId = $comment->get();
            $commentIds = array();
            foreach($commentId as $comments){
                array_push($commentIds,$comments->id);
            }
            $comment->delete();

            Reply::whereIn('comment_id',$commentIds)->delete();    
            
            return ;
    }

    public function updateCommentNum($postid, $getCount){
        Post::where('id',$postid)->update([
            'commentnum' => DB::raw('commentnum-'.$getCount)
        ]); 
    }

    public function comment(){
        $comment = Comment::join('posts','comments.post_id', '=','posts.id')
        ->select('*','comments.created_at as time','comments.id as id')
        ->orderBy('comments.id','desc')
        ->get();

        return view('admin.comment',compact('comment'));
    }

    public function reply(){
        $reply = Reply::join('comments','replies.comment_id', '=','comments.id')
        ->join('posts','comments.post_id','posts.id')
        ->select('*','replies.created_at as time','replies.id as id')
        ->orderBy('replies.id','desc')
        ->get();

        return view('admin.reply',compact('reply'));
    }

}
