<?php

namespace App\Interfaces;

use App\Models\VehicleTypes;

interface VehicleTypesRatesRepositoryInterface
{
    public function getAllByVehicleType(VehicleTypes $vehicleType);

}
