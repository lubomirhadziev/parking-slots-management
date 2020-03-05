<?php

namespace App\Repositories;

use App\Interfaces\SlotsRepositoryInterface;
use App\Models\Slots;
use App\Utils\Time;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class SlotsRepository implements SlotsRepositoryInterface
{
    const MAX_AVAILABLE_SLOTS = 200;

    private $timeUtils;

    public function __construct(Time $timeUtils)
    {
        $this->timeUtils = $timeUtils;
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
     * @param Slots $slot
     * @param Collection $rates
     * @return DateTime
     * @throws Exception
     */
    public function checkSlotAmount(Slots $slot, Collection $rates)
    {
        $startingTime = new DateTime($slot->starting_at);
        $endTime = ($slot->end_at != null ? new DateTime($slot->end_at) : new DateTime());
        $amount = 0;

        while ($startingTime <= $endTime) {
            $amount += $this->findAmountPerHour($startingTime, $rates);

            $startingTime = $startingTime->modify('+1 hour');
        }

        return $amount;
    }

    public function findSlotByVehicleNumber(string $vehicleNumber)
    {
        return Slots::where('vehicle_number', '=', $vehicleNumber)->first();
    }

    /**
     * @param DateTime $startingTime
     * @param Collection $rates
     * @return int|mixed
     */
    private function findAmountPerHour(DateTime $startingTime, Collection $rates)
    {
        $time = strtotime($startingTime->format('H:i:s'));

        foreach ($rates as $rate) {

            if ($this->timeUtils->isTimeBetween(strtotime($rate->from_time), strtotime($rate->to_time), $time)) {
                return $rate->amount_per_hour;
            }
        }

        return 0;
    }

}
