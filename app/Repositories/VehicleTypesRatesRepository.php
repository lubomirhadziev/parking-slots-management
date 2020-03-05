<?php

namespace App\Repositories;

use App\Interfaces\VehicleTypesRatesRepositoryInterface;
use App\Models\VehicleTypes;
use App\Models\VehicleTypesRates;

class VehicleTypesRatesRepository implements VehicleTypesRatesRepositoryInterface
{
    public function getAllByVehicleType(VehicleTypes $vehicleType)
    {
        return VehicleTypesRates::where('vehicle_types_rates.vehicle_type_id', '=', $vehicleType->id)
            ->join('rates', 'rates.id', '=', 'vehicle_types_rates.rate_id')
            ->select(
                'rates.from_time',
                'rates.to_time',
                'vehicle_types_rates.amount_per_hour'
            )
            ->get();
    }

}
