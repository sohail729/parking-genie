<?php

namespace App\Contracts;
/**
 * Interface UserContract
 * @package App\Contracts
 */
interface PlanContract {
    /**
     * @param array $params
     * @return mixed
     */
        
    public function store(array $params);

    public function update(array $params, $plan);

}
