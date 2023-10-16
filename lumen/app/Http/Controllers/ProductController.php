<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Repository\iProductRepo;

class ProductController extends Controller
{
    private iProductRepo $iproductrepo;

    public function __construct(iProductRepo $iproductRepo){
        $this->iproductRepo = $iproductRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all from the database
        
       //$products = Product::all();
        $products = $this->iproductRepo->all();
        return response()->json($products);
        
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
            'title' => 'required',
            'description' => 'required',
            'price' => 'required'

        ]);

        $data = $request->all();
        

        //uploading file
        if($request->hasFile('photo')){
            $file=$request->file('photo');
            $allowedfileExtension = ['pdf','png','jpg','jpeg'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            
            if($check){
                $photoname = time() . $file->getClientOriginalName();
                $file->move('images', $photoname);
                $data['photo']=$photoname;
                //$photo=$photoname;
            }
        }

        $this->product->createProduct($data);

        // $title=$request->title;
        // $description=$request->description;
        // $price=$request->price;
       

        

        // $product = new Product;
        // $product->title = $title;
        // $product->description = $description;
        // $product->price = $price;
        // $product->photo = $photo;
        
        if($product->save()){
            return response()->json(['status'=>'success','message'=>'Product created successfully']);
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
        $product = $this->product->getSingleProduct($id);//Product::findOrFail($id);
        return response()->json($product);
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
        // $title=$request->title;
        // $description=$request->description;
        // $price=$request->price;

        //Validation the requests
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'price' => 'required'

        ]);

        
        
         //uploading file
         if($request->hasFile('photo')){
            $file=$request->file('photo');
            $allowedfileExtension = ['pdf','png','jpg','jpeg'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            
            if($check){
                $photoname = time() . $file->getClientOriginalName();
                $file->move('images', $photoname);
                $data['photo']=$photoname;
            }
        }

        $product = $this->product->updateProduct($id, $data);

        // $product = Product::findOrFail($id);
        // $product->title = $title;
        // $product->description = $description;
        // $product->price = $price;
        // $product->photo = $photo;
        
        if($product->save()){
            return response()->json(['status'=>'success','message'=>'Product updated successfully']);
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
        $this->product->deleteProduct($id);
        $product = Product::findOrFail($id);
        if($product->delete()){
            return response()->json(['status'=>'success','message'=>'Product deleted successfully']);
        }else{
            return response()->json(['status'=>'error','message'=>'Something Wrong  !!!']);
        }

    }
}
