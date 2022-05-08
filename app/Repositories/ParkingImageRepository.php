<?php

namespace App\Repositories;

use App\Contracts\ParkingImageContract;
use App\Models\ParkingImage;

class ParkingImageRepository extends AbstractRepository implements ParkingImageContract
{
    protected $model;

    public function __construct(ParkingImage $parkingImage)
    {
        $this->model = $parkingImage;
    }  

    public function store($data, $detailId)
    { 
        $images = [];
        foreach ($data as $key => $item) {
            $images[$key]['parking_id'] = $detailId;
            $images[$key]['image'] = $this->fileUpload($item, 'uploads/parking');
            $images[$key]['created_at'] = now();
            $images[$key]['updated_at'] = now();
        }
        $response = $this->model->insert($images);
        return $response ;
    }
}
