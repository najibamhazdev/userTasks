<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use App\Repository\iTaskRepo;

class TaskController extends Controller
{
    // private iTaskRepo $iTaskrepo;

    // public function __construct(iTaskRepo $itaskRepo){
    //     $this->itaskRepo = $itaskRepo;
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all from the database
        
       $tasks = Task::all();
       // $tasks = $this->itaskRepo->all();
        return response()->json($tasks);
        
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
            'user_id' => 'required'

        ]);

        $data = $request->all();

        //$this->task->createTask($data);

        $title=$request->title;
        $description=$request->description;
        $user_id=$request->user_id;
       

        

        $task = new Task;
        $task->title = $title;
        $task->description = $description;
        $task->user_id = $user_id;
        
        
        if($task->save()){
            return response()->json(['status'=>'success','message'=>'Task created successfully']);
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
        $task = $this->task->getSingleTask($id);//Task::findOrFail($id);
        return response()->json($task);
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

        $task = $this->task->updateTask($id, $data);

        // $task = Task::findOrFail($id);
        // $task->title = $title;
        // $task->description = $description;
        // $task->price = $price;
        // $task->photo = $photo;
        
        if($task->save()){
            return response()->json(['status'=>'success','message'=>'Task updated successfully']);
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
        $this->task->deleteTask($id);
        $task = Task::findOrFail($id);
        if($task->delete()){
            return response()->json(['status'=>'success','message'=>'Task deleted successfully']);
        }else{
            return response()->json(['status'=>'error','message'=>'Something Wrong  !!!']);
        }

    }
}
