<?php

namespace App\Services;

use App\Interfaces\SlotsRepositoryInterface;
use App\Interfaces\SlotsServiceInterface;
use App\Models\Slots;
use App\Repositories\VehicleTypesRatesRepository;
use App\Utils\TimeUtils;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class SlotsService implements SlotsServiceInterface
{
    private $slotsRepository;
    private $vehicleTypesRatesRepository;
    private $timeUtils;

    /**
     * @param TimeUtils $timeUtils
     * @param SlotsRepositoryInterface $slotsRepository
     * @param VehicleTypesRatesRepository $vehicleTypesRatesRepository
     */
    public function __construct(
        TimeUtils $timeUtils,
        SlotsRepositoryInterface $slotsRepository,
        VehicleTypesRatesRepository $vehicleTypesRatesRepository
    )
    {
        $this->timeUtils = $timeUtils;
        $this->slotsRepository = $slotsRepository;
        $this->vehicleTypesRatesRepository = $vehicleTypesRatesRepository;
    }

    /**
     * @param string $vehicleNumber
     * @return float
     * @throws Exception
     */
    public function amount(string $vehicleNumber)
    {
        $slot = $this->slotsRepository->findSlotByVehicleNumber($vehicleNumber);
        $rates = $this->vehicleTypesRatesRepository->getAllByVehicleType($slot->vehicle_type);

        return $this->checkSlotAmount($slot, $rates);
    }

    /**
     * @param Slots $slot
     * @param Collection $rates
     * @return int
     * @throws Exception
     */
    private function checkSlotAmount(Slots $slot, Collection $rates)
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

    /**
     * @param DateTime $startingTime
     * @param Collection $rates
     * @return int
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
