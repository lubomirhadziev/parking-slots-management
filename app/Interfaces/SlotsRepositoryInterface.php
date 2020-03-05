<?php

namespace App\Interfaces;

use App\Models\DiscountCards;
use App\Models\VehicleTypes;

interface SlotsRepositoryInterface
{
    public function countFreeSlots();

    public function findSlotByVehicleNumber(string $vehicleNumber);

    public function isVehicleCheckedIn(string $vehicleNumber);

    public function createSlot(string $vehicleNumber, VehicleTypes $vehicleType, DiscountCards $card = null);

    public function checkOutSlot(string $vehicleNumber);

}
