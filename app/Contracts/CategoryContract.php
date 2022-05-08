<?php

namespace App\Contracts;
/**
 * Interface UserContract
 * @package App\Contracts
 */
interface CategoryContract {
    /**
     * @param array $params
     * @return mixed
     */
        
    public function store(array $params);

    public function update(array $params, $category);

    public function delete(int $catId);

}
