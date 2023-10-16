<?php

namespace App\Repository;

use App\Models\Category;

class CategoryRepo implements iCategoryRepo {
    
    
    public function all(): array{
        $categories = Category::all()->toArray();
        return $categories;
    }


    public function createCategory(array $data){

        Category::insert([
            'title'=>$data['title']
        ]);
    }


    public function getSingleCategory($id){
        return Category::findOrFail($id);
    }

    public function updateCategory($id, array $data){

        $category = Category::findOrFail($id);
        $category->update([
            'title'=>$data['title'],
            'description'=>$data['description'],
            'price'=>$data['price']
        ]);
    }
}