<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
     /**
     * The model to execute queries on
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Create a new repository instance
     * @param \Illuminate\Database\Eloquent\Model $model The model to execute queries on
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function fileUpload($file, $path)
    {
        if($file){
            $newName = time().rand(1,99).'.'.$file->getClientOriginalExtension(); 
            $file->move(public_path($path), $newName); 
            return $newName; 
        }
        return null;   
    }
}

?>