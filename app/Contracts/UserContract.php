<?php

namespace App\Contracts;
/**
 * Interface UserContract
 * @package App\Contracts
 */
interface UserContract {
    /**
     * @param array $params
     * @return mixed
     */
        
    public function userSignup(array $params);
    
    public function createSubscription(array $params, $userId, $invoice);
    
    public function update(array $params, $userId);

    public function destroy($userId);

}
