<?php

namespace App\Repository;

interface iCategoryRepo {

    public function all(): array;

    public function createCategory(array $data);

    public function getSingleCategory($id);

    public function updateCategory($id, array $data);

    

}