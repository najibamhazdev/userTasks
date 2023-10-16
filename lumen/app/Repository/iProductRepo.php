<?php

namespace App\Repository;

interface iProductRepo {

    public function all(): array;

    public function createProduct(array $data);

    public function getSingleProduct($id);

    public function updateProduct($id, array $data);

    

}