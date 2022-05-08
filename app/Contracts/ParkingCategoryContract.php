<?php

namespace App\Contracts;
/**
 * Interface ParkingCategoryContract
 * @package App\Contracts
 */
interface ParkingCategoryContract {
    /**
     * @param array $params
     * @return mixed
     */
        
    public function store(array $params, int $detailId);

}
