<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Repository\iCategoryRepo;

class CategoryController extends Controller
{
    private iCategoryRepo $icategoryRepo;

    public function __construct(iCategoryRepo $icategoryRepo){
        $this->icategoryRepo = $icategoryRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all from the database
       
        $categories = $this->icategoryRepo->all();
        return response()->json($categories);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation the requests

        $this->validate($request,[
            'title' => 'required'
            
       ]);
        # by repository
        //$data = $request->all();
        //$this->category->createCategory($data);

        $title=$request->title;
        $category= new Category;
        $category->title = $title;

        if($category->save()){
            return response()->json(['status'=>'success','message'=>'Category created successfully']);
        }else{
            return response()->json(['status'=>'error','message'=>'Something Wrong  !!!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //by Repo
        //$category = $this->category->getSingleCategory($id);
        $category = Category::findOrFail($id);
        return response()->json($category);
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

        $data = $request->all();
        $title=$request->title;
        
        
        
         
        //By Repo
        //$category = $this->category->updateCategory($id, $data);
       
        $category= Category::findOrFail($id);
        $category->title = $title;
     
        
        if($category->save()){
            return response()->json(['status'=>'success','message'=>'Category updated successfully']);
        }else{
            return response()->json(['status'=>'error','message'=>'Something Wrong  !!!']);
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
        //By Repo
        //$this->category->deleteCategory($id);
        $category = Category::findOrFail($id);
        if($category->delete()){
            return response()->json(['status'=>'success','message'=>'Category deleted successfully']);
        }else{
            return response()->json(['status'=>'error','message'=>'Something Wrong  !!!']);
        }

    }
}
