<?php

namespace App\Contracts;
/**
 * Interface ParkingImageContract
 * @package App\Contracts
 */
interface ParkingImageContract {
    /**
     * @param array $params
     * @return mixed
     */
        
    public function store(array $params, int $detailId);

    // public function update(array $params, $category);

    // public function delete(int $catId);

}
