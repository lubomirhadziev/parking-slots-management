<?php

namespace App\Interfaces;

interface VehicleTypesRepositoryInterface
{
    public function findByKey(string $key);

}
