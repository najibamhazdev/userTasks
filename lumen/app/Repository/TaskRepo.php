<?php

namespace App\Repository;

use App\Models\Task;

class TaskRepo implements iTaskRepo {
    
    
    public function all(): array{
        $categories = Task::all()->toArray();
        return $categories;
    }


    public function createTask(array $data){

        Task::insert([
            'title'=>$data['title']
        ]);
    }


    public function getSingleTask($id){
        return Task::findOrFail($id);
    }

    public function updateTask($id, array $data){

        $Task = Task::findOrFail($id);
        $Task->update([
            'title'=>$data['title'],
            'description'=>$data['description'],
            'price'=>$data['price']
        ]);
    }
}