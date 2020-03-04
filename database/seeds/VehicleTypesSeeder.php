<?php

use App\Models\VehicleTypes;
use Illuminate\Database\Seeder;

class VehicleTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VehicleTypes::create(['key' => 'A', 'title' => 'Category A', 'parking_slots' => 1]);
        VehicleTypes::create(['key' => 'B', 'title' => 'Category B', 'parking_slots' => 2]);
        VehicleTypes::create(['key' => 'C', 'title' => 'Category C', 'parking_slots' => 4]);
    }
}
