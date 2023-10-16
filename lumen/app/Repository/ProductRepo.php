<?php

namespace App\Repository;

use App\Models\Product;

class ProductRepo implements iProductRepo {
    
    
    public function all(): array{
        $products = Product::all()->toArray();
        return $products;
    }


    public function createProduct(array $data){

        Product::insert([
            'title'=>$data['title'],
            'description'=>$data['description'],
            'price'=>$data['price']
        ]);
    }


    public function getSingleProduct($id){
        return Product::findOrFail($id);
    }

    public function updateProduct($id, array $data){

        $product = Product::findOrFail($id);
        $product->update([
            'title'=>$data['title'],
            'description'=>$data['description'],
            'price'=>$data['price']
        ]);
    }
}