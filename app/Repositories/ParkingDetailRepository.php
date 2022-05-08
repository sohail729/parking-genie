<?php

namespace App\Repositories;

use App\Contracts\ParkingDetailContract;
use App\Models\ParkingDetail;

class ParkingDetailRepository implements ParkingDetailContract
{
    protected $model;

    public function __construct(ParkingDetail $category)
    {
        $this->model = $category;
    }  

    public function store($data)
    { 
        $response = $this->model->create($data);
        $response->categories()->sync($data['category']);        
        return $response->id;
    }

    public function update($space, $data)
    { 
        $response = $space->update($data);
        return $response;
    }

    public function getSingle($id)
    { 
        $response = $this->model->find($id);
        return $response;
    }

    public function getAllSpaces()
    { 
        $response = $this->model->paginate(10);
        return $response;
    }

    // public function update($data, $category) : bool
    // { 
    //     $response = $this->model->find($category->id)->update($data);
    //     return $response;
    // }
    // public function delete($category) : bool
    // { 
    //     $response = $this->model->find($category->id)->delete();
    //     return $response;
    // }
}
