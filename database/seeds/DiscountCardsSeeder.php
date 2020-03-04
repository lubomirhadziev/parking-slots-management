<?php

use App\Models\DiscountCards;
use Illuminate\Database\Seeder;

class DiscountCardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DiscountCards::create(['key' => 'silver', 'title' => 'Silver', 'discount_percentage' => 10]);
        DiscountCards::create(['key' => 'gold', 'title' => 'Gold', 'discount_percentage' => 15]);
        DiscountCards::create(['key' => 'platinum', 'title' => 'Platinum', 'discount_percentage' => 20]);
    }
}
