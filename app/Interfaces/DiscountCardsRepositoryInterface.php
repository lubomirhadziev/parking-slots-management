<?php

namespace App\Interfaces;

interface DiscountCardsRepositoryInterface
{
    public function findByKey(string $key);

}
