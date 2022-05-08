<?php

namespace App\Contracts;
/**
 * Interface ParkingDetailContract
 * @package App\Contracts
 */
interface ParkingDetailContract {
    /**
     * @param array $params
     * @return mixed
     */
        
    public function store(array $params);

    // public function update(array $params, $category);

    // public function delete(int $catId);

}
