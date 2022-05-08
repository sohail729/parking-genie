<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'type' => 'space',
                'title' => 'Grass',
            ],                
            [
                'type' => 'space',
                'title' => 'Asphalt',
            ],                
            [
                'type' => 'space',
                'title' => 'Gravel',
            ],                
            [
                'type' => 'space',
                'title' => 'Driveway',
            ],                
            [
                'type' => 'space',
                'title' => 'Lot',
            ],                
            [
                'type' => 'space',
                'title' => 'Garage',
            ],                
            [
                'type' => 'space',
                'title' => 'Covered parking',
            ], 
            [
                'type' => 'vehicle',
                'title' => 'Car',
            ],                
            [
                'type' => 'vehicle',
                'title' => 'Motorcycle',
            ],                
            [
                'type' => 'vehicle',
                'title' => 'Truck',
            ],                
            [
                'type' => 'vehicle',
                'title' => 'RV',
            ],                
            [
                'type' => 'vehicle',
                'title' => 'Bus',
            ],                
            [
                'type' => 'vehicle',
                'title' => 'Boat',
            ],                
            [
                'type' => 'vehicle',
                'title' => 'Boat trailer',
            ],                
            [
                'type' => 'vehicle',
                'title' => 'Wave runner ',
            ]              
        ];
        
        foreach($categories as $category) {
            Category::create($category);
        }
    }
}
