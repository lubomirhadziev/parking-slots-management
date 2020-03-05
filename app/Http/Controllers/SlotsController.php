<?php

namespace App\Http\Controllers;

use App\Interfaces\DiscountCardsRepositoryInterface;
use App\Interfaces\SlotsRepositoryInterface;
use App\Interfaces\SlotsServiceInterface;
use App\Interfaces\VehicleTypesRepositoryInterface;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class SlotsController extends BaseController
{
    private $slotsRepository;
    private $discountCardsRepository;
    private $vehicleTypesRepository;
    private $slotsService;

    /**
     * @param SlotsRepositoryInterface $slotsRepository
     * @param DiscountCardsRepositoryInterface $discountCardsRepository
     * @param VehicleTypesRepositoryInterface $vehicleTypesRepository
     * @param SlotsServiceInterface $slotsService
     */
    public function __construct(
        SlotsRepositoryInterface $slotsRepository,
        DiscountCardsRepositoryInterface $discountCardsRepository,
        VehicleTypesRepositoryInterface $vehicleTypesRepository,
        SlotsServiceInterface $slotsService
    )
    {
        $this->slotsRepository = $slotsRepository;
        $this->discountCardsRepository = $discountCardsRepository;
        $this->vehicleTypesRepository = $vehicleTypesRepository;
        $this->slotsService = $slotsService;
    }

    public function checkIn(Request $request)
    {
        $vehicleNumber = $request->json()->get('vehicle_number');
        $vehicleTypeKey = strtoupper($request->json()->get('vehicle_type'));
        $cardKey = $request->json()->get('card');
        $card = null;

        if ($this->slotsRepository->isVehicleCheckedIn($vehicleNumber)) {
            return response()->json(['error' => 'Vehicle is already checked in!'], 400);
        }

        $vehicleType = $this->vehicleTypesRepository->findByKey($vehicleTypeKey);

        if (!$vehicleType) {
            return response()->json(['error' => 'Vehicle type was not found!'], 400);
        }

        if ($cardKey) {
            $card = $this->discountCardsRepository->findByKey($cardKey);
        }

        $createdSlot = $this->slotsRepository->createSlot($vehicleNumber, $vehicleType, $card);

        if ($createdSlot) {
            return response(null, 201);
        }

        return response(null, 400);
    }

    public function checkOut(string $vehicleNumber)
    {
        if (!$this->slotsRepository->isVehicleCheckedIn($vehicleNumber)) {
            return response()->json(['error' => 'Vehicle is not checked in!'], 400);
        }

        $amount = $this->slotsService->amount($vehicleNumber);
        $this->slotsRepository->checkOutSlot($vehicleNumber);

        return response()->json(['amount' => $amount]);
    }

    public function freeSlots()
    {
        return response()->json(['free_slots' => $this->slotsRepository->countFreeSlots()]);
    }

    public function checkSlotAmount(Request $request)
    {
        $vehicleNumber = $request->json()->get('vehicle_number');

        if (!$this->slotsRepository->isVehicleCheckedIn($vehicleNumber)) {
            return response()->json(['error' => 'Vehicle is not checked in!'], 400);
        }

        return response()->json([
            'amount' => $this->slotsService->amount($vehicleNumber)
        ]);
    }


}
