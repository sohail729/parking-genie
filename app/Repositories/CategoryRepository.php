<?php

namespace App\Repositories;

use App\Models\Category;
use App\Contracts\CategoryContract;

class CategoryRepository implements CategoryContract
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }  

    public function store($data) : bool
    { 
        $response = $this->model->create($data);
        return $response->id;
    }

    public function update($data, $category) : bool
    { 
        $response = $this->model->find($category->id)->update($data);
        return $response;
    }
    public function delete($category) : bool
    { 
        $response = $this->model->find($category->id)->delete();
        return $response;
    }
}
