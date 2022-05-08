<?php

namespace App\Repositories;

use App\Models\Plan;
use App\Contracts\PlanContract;

class PlanRepository implements PlanContract
{
    protected $model;

    public function __construct(Plan $plan)
    {
        $this->model = $plan;
    }  

    public function store($data) : bool
    { 
        $response = $this->model->create($data);
        return $response->id;
    }

    public function update($data, $plan) : bool
    { 
        $response = $this->model->find($plan->id)->update($data);
        return $response;
    }
}
