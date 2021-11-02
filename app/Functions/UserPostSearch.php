<?
namespace App\Functions;
use App\Functions\SearchClass;
use App\models\Post;

class UserPostSearch extends SearchClass{

    var $name;
    var $val;
    var $search;

    public function __construct($name,$val,$search)
    {
        $this->name = $name;
        $this->val = $val;
        $this->search = $search;
    }

    public function searchResult(){

        $q = $this->search;

       if($this->val == 'seperately'){
           
           $searchResult = 
           Post::
           join('users', 'posts.user_id', '=', 'users.id')
           ->join('subcategories', 'posts.subcategory_id', '=', 'subcategories.id');

           $searchResult = $searchResult->where('writer',$this->name);

           $searchResult = $searchResult->where(function($query) use ($q){
               $query->where('posts.title','LIKE',"%{$q}%")
               ->orWhere('posts.description','LIKE',"%{$q}%");
           })
           
           ->select('*','posts.created_at as time','posts.id as idx')
           ->orderBy('posts.id','desc')
           ->paginate(16);         
       }



       else if($this->val == 'comment'){

           $searchResult = 
           Post::
           join('users', 'posts.user_id', '=', 'users.id')
           ->join('subcategories', 'posts.subcategory_id', '=', 'subcategories.id')
           ->join('comments', 'comments.post_id', '=', 'posts.id');
           $searchResult = $searchResult->
           where('writer',$this->name)
           ->where('comments.comment_content','LIKE',"%{$this->search}%")
           ->select('*','posts.created_at as time','posts.id as idx')
           ->orderBy('posts.id','desc')
           ->paginate(16);
       }



       else{

           $searchResult = 
           Post::
           join('users', 'posts.user_id', '=', 'users.id')
           ->join('subcategories', 'posts.subcategory_id', '=', 'subcategories.id');
           $searchResult = $searchResult->
           where('writer',$this->name)
           ->where('posts.'.$this->val,'LIKE','%'.$this->search.'%')
           ->select('*','posts.created_at as time','posts.id as idx')
           ->orderBy('posts.id','desc')
           ->paginate(16);  
       }

   return $searchResult;
}

}