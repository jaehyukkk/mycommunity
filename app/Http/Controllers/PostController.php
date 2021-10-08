<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Maincategory;
use App\Models\Subcategory;
use DOMDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;


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
        ->select('*','posts.created_at as time')
        ->get();

        $notice = Post::
          where('notice',1)
        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
        ->select('*','posts.created_at as time','posts.id as idx')
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
        ->paginate(5);

        $notice = Post::where('maincategory_id',$id)->where('subcategory_id',$subid)
        ->where('notice',2)
        ->orwhere('notice',1)
        ->leftJoin('users', 'posts.user_id', '=', 'users.id')
        ->select('*','posts.created_at as time','posts.id as idx')
        ->get();

        return view('post.subindex',compact('board','maincategory','subcategory','id','subid','notice'));
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

        $subid = $data['subid'];
        $int = Subcategory::where('id',$subid)->get('photocode');
        $code = $int[0]->photocode;

        if($code != 1){
            Post::create([
            'description' => $data['description'],
            'title' => $data['title'],
            'maincategory_id' => $data['caid'],
            'subcategory_id' => $data['subid'],
            'user_id' => $data['useridx'],
            'notice' => $data['notice'],
            'hit' => 0,
            'comment' => 0,         
           ]);
          return redirect('/board/'.$data['caid'].'/'.$data['subid']);
         }
         else{

            $dom = new domDocument;
            $dom->loadHTML(html_entity_decode($data['description']));
            $dom->preserveWhiteSpace = false;
            $imgs  = $dom->getElementsByTagName("img");
            if($imgs->length == 0){
                return redirect()->back()->with('alert','사진전용 게시판은 사진을 1개이상 올려야됩니다.');
            }

            $links = $imgs->item(0)->getAttribute("src");
            
            Post::create([
                'description' => $data['description'],
                'title' => $data['title'],
                'maincategory_id' => $data['caid'],
                'subcategory_id' => $data['subid'],
                'user_id' => $data['useridx'],
                'notice' => $data['notice'],
                'hit' => 0,
                'comment' => 0,
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
