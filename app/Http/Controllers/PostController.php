<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Maincategory;
use App\Models\Subcategory;
use App\Models\Comment;
use App\Models\Reply;
use DOMDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Gate;





class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {  
        $maincategory = Maincategory::all();
        $subcategory = Subcategory::all();
   
       
        $board = Post::
        where('posts.maincategory_id',$id)
        ->join('users', 'posts.user_id', '=', 'users.id')
        ->join('subcategories', 'posts.subcategory_id', '=', 'subcategories.id')
        ->select('*','posts.created_at as time','posts.id as idx','posts.maincategory_id as mainid')
        ->orderBy('posts.id','desc')
        ->paginate(16);

        $notice = Post::
        join('users', 'posts.user_id', '=', 'users.id')
        ->where('notice',1)
        ->select('*','posts.id as idx','posts.created_at as time')
        ->get();
        
        
        return view('post.index',compact('board','maincategory','subcategory','notice','id'));
       
    }

    public function subIndex($id,$subid){

        $maincategory = Maincategory::all();
        $subcategory = Subcategory::all();



        $board = DB::table('posts')
        ->where('posts.maincategory_id',$id)
        ->where('posts.subcategory_id',$subid)
        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
        ->leftJoin('subcategories', 'posts.subcategory_id', '=', 'subcategories.id')
        ->select('*','posts.created_at as time','posts.id as idx')
        ->orderBy('posts.id','desc')
        ->paginate(16);

        $notice = Post::where('maincategory_id',$id)->where('subcategory_id',$subid)
        ->where('notice',2)
        ->orwhere('notice',1)
        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
        ->select('*','posts.created_at as time','posts.id as idx')
        ->orderBy('posts.id','desc')
        ->get();

        return view('post.subindex',compact('board','maincategory','subcategory','id','subid','notice'));
    }



    public function viewAll()
    {  
   
        $board = DB::table('posts')
        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
        ->leftJoin('subcategories', 'posts.subcategory_id', '=', 'subcategories.id')
        ->select('*','posts.created_at as time','posts.id as idx','posts.maincategory_id as mainid')
        ->orderBy('posts.id','desc')
        ->paginate(16);      

        $notice = Post::
        join('users', 'posts.user_id', '=', 'users.id')
        ->where('notice',1)
        ->select('*','posts.id as idx','posts.created_at as time')
        ->orderBy('posts.id','desc')
        ->get();

        return view('post.viewall',compact('board','notice'));
       
    }


    public function imageuploadProcess(Request $request){

        if($request->hasfile('photo')){
            $photo = $request->file('photo');
               
                $name = time().rand(1,9999).'.'.$photo->extension();
                $photo->move(public_path('image'),$name);
           
        }
        $url = env('APP_URL').'/image/'.$name;

        return $url;
    }

    public function getNotice(Request $request){
        $id = $request->input('id');
        $subid = $request->input('subid');

        $notice = Post::where('maincategory_id',$id)->where('subcategory_id',$subid)
        ->where('notice',2)
        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
        ->select('*','posts.created_at as time','posts.id as idx')
        ->get();

        return $notice;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $subid)
    {   
        
        return view('post.create',compact('id','subid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $request->validate([
            'title'             => 'required|min:1|max:30',
            'description'       => 'required|min:1|max:10000',
        ]);

        $data = $request->all();

        if(isset($request->notice)){
            $data['notice'] = $request->notice;
        }
        else{
            $data['notice'] = 0;
        }

        $dom = new domDocument;
        $dom->loadHTML(html_entity_decode($data['description']));
        $dom->preserveWhiteSpace = false;
        $imgs  = $dom->getElementsByTagName("img");

        $subid = $data['subid'];
        $int = Subcategory::where('id',$subid)->first();
        $code = $int->photocode;
        $userid = Auth::user()->id;

        if($code != 1){
            Post::create([
            'description' => $data['description'],
            'title' => $data['title'],
            'maincategory_id' => $data['caid'],
            'subcategory_id' => $data['subid'],
            'user_id' => $userid,
            'notice' => $data['notice'],
            'hit' => 0,
            'comment' => 0,   
            'commentnum' => 0,
            'code' => $imgs->length,     
            'writer' => Auth::user()->name,     
           ]);
          return redirect('/board/'.$data['caid'].'/'.$data['subid']);
         }
         else{

            if($imgs->length == 0){
                return redirect()->back()->with('alert','???????????? ???????????? ????????? 1????????? ??????????????????.');
            }

            $links = $imgs->item(0)->getAttribute("src");
            
            Post::create([
                'description' => $data['description'],
                'title' => $data['title'],
                'maincategory_id' => $data['caid'],
                'subcategory_id' => $data['subid'],
                'user_id' => $userid,
                'notice' => $data['notice'],
                'hit' => 0,
                'comment' => 0,
                'commentnum' => 0,
                'mainimg' => $links,
                'writer' => Auth::user()->name,  
            ]);

            return redirect('/board/'.$data['caid'].'/'.$data['subid']);

         }
       
   
      
    }

    public function getCategoryTitle(Request $request){
        $idx = $request->input('id');
        $name = Subcategory::where('id',$idx)->get('subcategoryname');

        return $name;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        
        try{
        
        $this->hitSessions($id);
       
        $commentId = Comment::where('post_id',$id)->get('id');
        $comment = Post::find($id)->getComment;

        $read = DB::table('posts')
        ->where('posts.id',$id)
        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
        ->leftJoin('subcategories', 'posts.subcategory_id', '=', 'subcategories.id')
        ->select('*','posts.created_at as time','posts.id as id')
        ->orderBy('posts.id','desc')
        ->get();
        
        $comment = Comment::where('post_id',$id)->
        join('users', 'comments.user_id', 'users.id')
        ->select('*','comments.created_at as created_at','comments.id as id')
        ->get();

        $reply = Reply::whereIn('comment_id',$commentId)->
        join('users', 'replies.user_id', 'users.id')
        ->select('*','replies.created_at as created_at','replies.id as id')
        ->get();
        
        return view('post.show', compact('read','comment','reply'));  
        }
        catch(Exception $e){
            return redirect()->back()->with('alert','???????????? ?????? ??????????????????.');
        }
    }

    public function hitSessions($id){
        $bool = true;
        if(session()->has('hit')){

            foreach(session()->get('hit') as $hit){
                if($hit == $id){
                    $bool = false;
                    break;
                }
            }
            if($bool == true){
                session()->push('hit',$id);
                Post::where('id',$id)->update([
                    'hit' => DB::raw('hit+1')
                ]);
            }     
        }
        else{
            session()->push('hit',$id);
            Post::where('id',$id)->update([
                'hit' => DB::raw('hit+1')
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idx)
    {   
        $post = Post::find($idx);

        if(!Gate::allows('edit-post', $post) ){
            return redirect()->back();
        } 

        return view('post.edit',compact('post'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'title'             => 'required|min:1|max:30',
            'description'       => 'required|min:1|max:10000',
        ]);
        
        $data = $request->all();
        $dom = new domDocument;
        $dom->loadHTML(html_entity_decode($data['description']));
        $dom->preserveWhiteSpace = false;
        $imgs  = $dom->getElementsByTagName("img");
        
        $post = Post::find($id);

        if(!Gate::allows('edit-post', $post) ){
            return redirect()->back();
        }

        else{
            if(isset($data['notice'])){
                $post->update([
                    'title' => $data['title'],
                    'description' =>$data['description'],
                    'notice' =>$data['notice'],
                    'code' => $imgs->length
                ]);
            }
            else{
                $post->update([
                    'title' => $data['title'],
                    'description' =>$data['description'],
                    'code' => $imgs->length
                ]);
            }
           
            
            return redirect('/board/'.$data['caid'].'/'.$data['subid']);

        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(!Gate::allows('edit-post', $post) ){
            return redirect()->back();
        }

        else{

            $mainid = Post::where('id',$id)->first();
            $subid = Post::where('id',$id)->first();
            
            Post::where('id',$id)->delete();

            $mid = $mainid->maincategory_id;
            $sid = $subid->subcategory_id;
            return redirect('/board/'.$mid.'/'.$sid); 

        }

            

    }


}
