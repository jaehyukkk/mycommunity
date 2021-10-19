<?php
namespace App\Functions;
use App\Functions\SearchClass;
use App\Models\Post;

class SubSearchClass extends SearchClass{

    var $subid;
    var $id;
    var $val;
    var $search;

    public function __construct($subid, $id, $val, $search)
    {   
        $this->subid = $subid;
        $this->id = $id;
        $this->val = $val;
        $this->search = $search;
    }


    public function searchResult(){
        $q = $this->search;

        if($this->val == 'seperately'){
            $searchResult = 

            Post::
            join('users', 'posts.user_id', '=', 'users.id')
            ->join('subcategories', 'posts.subcategory_id', '=', 'subcategories.id')
            ->where('posts.maincategory_id', $this->id)
            ->where('posts.subcategory_id', $this->subid)
            ->where(function($query) use ($q){
                $query->where('posts.title','LIKE',"%{$q}%")
                ->orWhere('posts.description','LIKE',"%{$q}%");
            })->paginate(16);
            
        }

        else if($this->val == 'comment'){
            $searchResult = 
            Post::
            join('users', 'posts.user_id', '=', 'users.id')
            ->join('subcategories', 'posts.subcategory_id', '=', 'subcategories.id')
            ->join('comments', 'comments.post_id', '=', 'posts.id')
            ->where('posts.maincategory_id', $this->id)
            ->where('posts.subcategory_id', $this->subid)
            ->where('comments.comment_content','LIKE',"%{$this->search}%")
            ->select('*','posts.created_at as time','posts.id as idx','posts.maincategory_id as mainid')
            ->orderBy('posts.id','desc')
            ->paginate(16);
        }

        else{
            $searchResult = 
            Post::
            join('users', 'posts.user_id', '=', 'users.id')
            ->join('subcategories', 'posts.subcategory_id', '=', 'subcategories.id')
            ->where('posts.maincategory_id', $this->id)
            ->where('posts.subcategory_id', $this->subid)
            ->where('posts.'.$this->val,'LIKE','%'.$this->search.'%')
            ->select('*','posts.created_at as time','posts.id as idx','posts.maincategory_id as mainid')
            ->orderBy('posts.id','desc')
            ->paginate(16);  
        }

    return $searchResult;
}
 
}