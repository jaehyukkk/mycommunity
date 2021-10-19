<?php
namespace App\Functions;
use App\Models\Post;

class SearchClass{

    var $subid;
    var $id;
    var $val;
    var $search;

    public function __construct($id,$subid,$val,$search)
    {   
        $this->subid = $subid;
        $this->id = $id;
        $this->val = $val;
        $this->search = $search;
    }

    public function chgTheValue(){

        switch($this->val){
            case 1:
                $this->val = 'seperately';
                break;
            case 2:
                $this->val = 'title';
                break;
            case 3: 
                $this->val = 'description';
                break;
            case 4:
                $this->val = 'writer';
                break;
            case 5:
                $this->val = 'comment';
                break;
        }
    }

    public function searchResult(){

         $q = $this->search;

        if($this->val == 'seperately'){
            
            $searchResult = 
            Post::
            join('users', 'posts.user_id', '=', 'users.id')
            ->join('subcategories', 'posts.subcategory_id', '=', 'subcategories.id');

            if($this->id >= 1 && $this->subid == 0){
                $searchResult = $searchResult->where('posts.maincategory_id', $this->id);
            }

            if($this->subid >= 1 ){
                $searchResult = $searchResult->where('posts.maincategory_id', $this->id)
                ->where('posts.subcategory_id', $this->subid); 
            }

            $searchResult = $searchResult->where(function($query) use ($q){
                $query->where('posts.title','LIKE',"%{$q}%")
                ->orWhere('posts.description','LIKE',"%{$q}%");
            })
            
            ->select('*','posts.created_at as time','posts.id as idx','posts.maincategory_id as mainid')
            ->orderBy('posts.id','desc')
            ->paginate(16);         
        }



        else if($this->val == 'comment'){

            $searchResult = 
            Post::
            join('users', 'posts.user_id', '=', 'users.id')
            ->join('subcategories', 'posts.subcategory_id', '=', 'subcategories.id')
            ->join('comments', 'comments.post_id', '=', 'posts.id');

            if($this->id >= 1 && $this->subid == 0){
                $searchResult = $searchResult->where('posts.maincategory_id', $this->id);
            }

            if($this->subid >= 1 ){
                $searchResult = $searchResult->where('posts.maincategory_id', $this->id)
                ->where('posts.subcategory_id', $this->subid); 
            }

            $searchResult = $searchResult->
              where('comments.comment_content','LIKE',"%{$this->search}%")
            ->select('*','posts.created_at as time','posts.id as idx','posts.maincategory_id as mainid')
            ->orderBy('posts.id','desc')
            ->paginate(16);
        }



        else{

            $searchResult = 
            Post::
            join('users', 'posts.user_id', '=', 'users.id')
            ->join('subcategories', 'posts.subcategory_id', '=', 'subcategories.id');
            if($this->id >= 1 && $this->subid == 0){
                $searchResult = $searchResult->where('posts.maincategory_id', $this->id);
            }
            if($this->subid >= 1 ){
                $searchResult = $searchResult->where('posts.maincategory_id', $this->id)
                ->where('posts.subcategory_id', $this->subid); 
            }
            $searchResult = $searchResult->where('posts.'.$this->val,'LIKE','%'.$this->search.'%')
            ->select('*','posts.created_at as time','posts.id as idx','posts.maincategory_id as mainid')
            ->orderBy('posts.id','desc')
            ->paginate(16);  
        }

    return $searchResult;
}


}
