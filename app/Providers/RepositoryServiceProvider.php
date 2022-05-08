<?php

namespace App\Providers;

use App\Contracts\CategoryContract;
use App\Contracts\ParkingDetailContract;
use App\Contracts\ParkingImageContract;
use App\Contracts\PlanContract;
use App\Contracts\UserContract;
use App\Repositories\CategoryRepository;
use App\Repositories\ParkingDetailRepository;
use App\Repositories\ParkingImageRepository;
use App\Repositories\PlanRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        UserContract::class => UserRepository::class,
        CategoryContract::class => CategoryRepository::class,
        PlanContract::class => PlanRepository::class,
        ParkingDetailContract::class => ParkingDetailRepository::class,
        ParkingImageContract::class => ParkingImageRepository::class,
    ];
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }
}
