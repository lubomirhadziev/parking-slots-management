<?php

namespace App\Repositories;

use App\Interfaces\SlotsRepositoryInterface;
use App\Models\DiscountCards;
use App\Models\Slots;
use App\Models\VehicleTypes;
use App\Utils\TimeUtils;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class SlotsRepository implements SlotsRepositoryInterface
{
    // TODO: move to config or .env
    const MAX_AVAILABLE_SLOTS = 200;

    /**
     * @param string $vehicleNumber
     * @param VehicleTypes $vehicleType
     * @param DiscountCards $card
     * @return Slots
     */
    public function createSlot(string $vehicleNumber, VehicleTypes $vehicleType, DiscountCards $card = null)
    {
        $slot = new Slots();
        $slot->vehicle_number = $vehicleNumber;
        $slot->vehicle_type_id = $vehicleType->id;
        $slot->discount_card_id = $card->id ?? null;
        $slot->save();

        return $slot;
    }

    /**
     * @return int
     */
    public function countFreeSlots()
    {
        return self::MAX_AVAILABLE_SLOTS - (
            Slots::whereNull('slots.end_at')
                ->join('vehicle_types', 'slots.vehicle_type_id', '=', 'vehicle_types.id')
                ->sum('parking_slots')
            );
    }

    /**
     * @param string $vehicleNumber
     * @return Slots
     */
    public function findSlotByVehicleNumber(string $vehicleNumber)
    {
        return Slots::where('vehicle_number', '=', $vehicleNumber)
            ->whereNull('end_at')
            ->first();
    }

    /**
     * @param string $vehicleNumber
     * @return boolean
     */
    public function isVehicleCheckedIn(string $vehicleNumber)
    {
        return Slots::where('vehicle_number', '=', $vehicleNumber)
            ->whereNull('end_at')
            ->exists();
    }

    /**
     * @param string $vehicleNumber
     * @throws Exception
     */
    public function checkOutSlot(string $vehicleNumber)
    {
        $slot = $this->findSlotByVehicleNumber($vehicleNumber);
        $slot->end_at = new DateTime();
        $slot->save();
    }

}
