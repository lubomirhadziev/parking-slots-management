<?php

namespace App\Interfaces;

use App\Models\Slots;
use Illuminate\Database\Eloquent\Collection;

interface SlotsRepositoryInterface
{
    public function countFreeSlots();

    public function checkSlotAmount(Slots $slot, Collection $rates);

    public function findSlotByVehicleNumber(string $vehicleNumber);

}
