<?php

namespace App\Repository;

interface iTaskRepo {

    public function all(): array;

    public function createTask(array $data);

    public function getSingleTask($id);

    public function updateTask($id, array $data);

    

}