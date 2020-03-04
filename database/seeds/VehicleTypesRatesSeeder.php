<?php

use App\Models\Rates;
use App\Models\VehicleTypes;
use App\Models\VehicleTypesRates;
use Illuminate\Database\Seeder;

class VehicleTypesRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicleTypeA = VehicleTypes::where('key', 'A')->first()->id;
        $vehicleTypeB = VehicleTypes::where('key', 'B')->first()->id;
        $vehicleTypeC = VehicleTypes::where('key', 'C')->first()->id;

        $dayRate = Rates::find(1)->id;
        $nightRate = Rates::find(2)->id;

        VehicleTypesRates::create(['vehicle_type_id' => $vehicleTypeA, 'rate_id' => $dayRate, 'amount_per_hour' => 3]);
        VehicleTypesRates::create(['vehicle_type_id' => $vehicleTypeA, 'rate_id' => $nightRate, 'amount_per_hour' => 2]);

        VehicleTypesRates::create(['vehicle_type_id' => $vehicleTypeB, 'rate_id' => $dayRate, 'amount_per_hour' => 6]);
        VehicleTypesRates::create(['vehicle_type_id' => $vehicleTypeB, 'rate_id' => $nightRate, 'amount_per_hour' => 4]);

        VehicleTypesRates::create(['vehicle_type_id' => $vehicleTypeC, 'rate_id' => $dayRate, 'amount_per_hour' => 12]);
        VehicleTypesRates::create(['vehicle_type_id' => $vehicleTypeC, 'rate_id' => $nightRate, 'amount_per_hour' => 8]);
    }
}
