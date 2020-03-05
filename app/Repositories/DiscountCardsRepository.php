<?php

namespace App\Repositories;

use App\Interfaces\DiscountCardsRepositoryInterface;
use App\Models\DiscountCards;

class DiscountCardsRepository implements DiscountCardsRepositoryInterface
{

    /**
     * @param string $key
     * @return DiscountCards
     */
    public function findByKey(string $key)
    {
        return DiscountCards::where('key', '=', $key)->first();
    }

}
