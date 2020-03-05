<?php

namespace App\Http\Controllers;

use App\Interfaces\RatesRepositoryInterface;
use App\Interfaces\SlotsRepositoryInterface;
use App\Repositories\VehicleTypesRatesRepository;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class SlotsController extends BaseController
{
    private $slotsRepository;
    private $vehicleTypesRatesRepository;

    /**
     * @param SlotsRepositoryInterface $slotsRepository
     * @param VehicleTypesRatesRepository $vehicleTypesRatesRepository
     */
    public function __construct(
        SlotsRepositoryInterface $slotsRepository,
        VehicleTypesRatesRepository $vehicleTypesRatesRepository
    )
    {
        $this->slotsRepository = $slotsRepository;
        $this->vehicleTypesRatesRepository = $vehicleTypesRatesRepository;
    }

    public function freeSlots()
    {
        return response()->json(['free_slots' => $this->slotsRepository->countFreeSlots()]);
    }

    public function checkSlotAmount(Request $request)
    {
        $vehicleNumber = $request->json()->get('vehicle_number');
        $slot = $this->slotsRepository->findSlotByVehicleNumber($vehicleNumber);
        $rates = $this->vehicleTypesRatesRepository->getAllByVehicleType($slot->vehicle_type);

        $amount = $this->slotsRepository->checkSlotAmount($slot, $rates);

        return response()->json(['amount' => $amount]);
    }


}
