<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Maincategory;
use App\Models\Subcategory;
use App\Models\Comment;
use App\Models\Reply;
use DOMDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Session;

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

        $board = DB::table('posts')
        ->where('posts.maincategory_id',$id)
        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
        ->leftJoin('subcategories', 'posts.subcategory_id', '=', 'subcategories.id')
        ->select('*','posts.created_at as time','posts.id as idx','posts.maincategory_id as mainid')
        ->orderBy('posts.id','desc')
        ->paginate(16);

        // $board = PostResource::collection($boards);

        $notice = Post::
          
        join('users', 'posts.user_id', '=', 'users.id')
        ->where('notice',1)
        ->select('*','posts.id as idx','posts.created_at as time')
        ->get();

        $int = Maincategory::where('id',$id)->get('photocode');
        $photocode = $int[0]->photocode;

        return view('post.index',compact('board','maincategory','subcategory','notice','id','photocode'));
       
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

        $int = Subcategory::where('id',$subid)->get('photocode');
        $photocode = $int[0]->photocode;

        return view('post.subindex',compact('board','maincategory','subcategory','id','subid','notice','photocode'));
    }


    public function imageupload(){
        return view('post.image');
    }

    public function imageuploadProcess(Request $request){

        if($request->hasfile('photo')){
            $photo = $request->file('photo');
               
                $name = time().rand(1,9999).'.'.$photo->extension();
                $photo->move(public_path('image'),$name);
           
        }
        $url = 'http://127.0.0.1:8000/image/'.$name;

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
        $maincategory = Maincategory::all();
        $subcategory = Subcategory::all();
        return view('post.create',compact('maincategory','subcategory','id','subid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = $request->all();

        $dom = new domDocument;
        $dom->loadHTML(html_entity_decode($data['description']));
        $dom->preserveWhiteSpace = false;
        $imgs  = $dom->getElementsByTagName("img");

        $subid = $data['subid'];
        $int = Subcategory::where('id',$subid)->get('photocode');
        $code = $int[0]->photocode;
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
                return redirect()->back()->with('alert','사진전용 게시판은 사진을 1개이상 올려야됩니다.');
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
                'mainimg' => $links,
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
        }
        

        $read = DB::table('posts')
        ->where('posts.id',$id)
        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
        ->leftJoin('subcategories', 'posts.subcategory_id', '=', 'subcategories.id')
        ->select('*','posts.created_at as time','posts.id as idx')
        ->orderBy('posts.id','desc')
        ->get();

        $maincategory = Maincategory::all();
        $subcategory = Subcategory::all();

        $commentId = Comment::where('post_id',$id)->get('id');

        $comment = Post::find($id)->getComment;
        $reply = Reply::whereIn('comment_id',$commentId)->get();
        
        return view('post.show', compact('maincategory','subcategory','read','comment','reply'));  
        }
        catch(Exception $e){
            return redirect()->back()->with('alert','존재하지 않는 게시글입니다.');
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
        $postUserId = Post::where('id',$idx)->get('user_id');
        
        if(Auth::user()->id != $postUserId[0]->user_id){
            return redirect()->back();
        }

        $post = Post::where('id',$idx)->get();
        $sub = Post::where('id',$idx)->get('subcategory_id');
        $main = Post::where('id',$idx)->get('maincategory_id');
        $maincategory = Maincategory::all();
        $subcategory = Subcategory::all();

        $id = $main[0]->maincategory_id;
        $subid = $sub[0]->subcategory_id;

        return view('post.edit',compact('post','maincategory','subcategory','id','subid'));
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
        $data = $request->all();
        Post::where('id',$id)->update([
            'title' => $data['title'],
            'description' =>$data['description'],
            'notice' =>$data['notice']
        ]);
        
        return redirect('/board/'.$data['caid'].'/'.$data['subid']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $mainid = Post::where('id',$id)->get('maincategory_id');
            $subid = Post::where('id',$id)->get('subcategory_id');
            
            Post::where('id',$id)->delete();

            $mid = $mainid[0]->maincategory_id;
            $sid = $subid[0]->subcategory_id;
            return redirect('/board/'.$mid.'/'.$sid); 

    }

    
    public function mobileBoard(){
        $main = Maincategory::all();
        $sub = Subcategory::all();
        return view('post.mobile.board',compact('main','sub'));
    }
}
