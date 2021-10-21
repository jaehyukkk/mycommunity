<?php

namespace App\Http\Controllers;

use App\Models\Maincategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $maincategory = Maincategory::all();
        $subcategory = Subcategory::all();

        return view('admin.category',compact('maincategory','subcategory'));
    }

    public function addCategory(Request $request){

        $data = $request->all();

        $this->categoryDivision($data);

        return redirect()->back();
    }

    public function categoryDivision(array $data){

        if($data['division'] == 0){
            Maincategory::create([
                'maincategoryname' => $data['name'],
                'photocode'        => $data['purpose'],
            ]);
        }
        else{
            Subcategory::create([
                'subcategoryname' => $data['name'],
                'maincategory_id' => $data['maincategory_id'],
                'photocode'       => $data['purpose']
            ]);
        }

        return;
    }

    public function updateCategory(Request $request){
        $data = $request->all();

        $this->updateCategoryResult($data);
        
        return redirect()->back();

    }

    public function updateCategoryResult(array $data){

        if($data['division'] == 0){
            Maincategory::where('id',$data['categoryid'])->update([
                'maincategoryname' => $data['name'],
                'photocode'        => $data['purpose'],
            ]);
        }
        else{
            Subcategory::where('id',$data['categoryid'])->update([
                'subcategoryname' => $data['name']
            ]);
        }
    }

    public function delCategory(Request $request){
        $data = $request->all();

        if($data['division'] == 0){
            Maincategory::where('id',$data['categoryid'])->delete();
        }
        else{
            Subcategory::where('id',$data['categoryid'])->delete();
        }

        return redirect()->back();
    }

}
