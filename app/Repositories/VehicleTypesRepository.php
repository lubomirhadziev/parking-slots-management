<?php

namespace App\Repositories;

use App\Interfaces\VehicleTypesRepositoryInterface;
use App\Models\VehicleTypes;

class VehicleTypesRepository implements VehicleTypesRepositoryInterface
{
    /**
     * @param string $key
     * @return VehicleTypes
     */
    public function findByKey(string $key)
    {
        return VehicleTypes::where('key', '=', $key)->first();
    }

}
