<?php

use App\Models\Rates;
use Illuminate\Database\Seeder;

class RatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rates::create(['title' => 'Day rate', 'from_time' => '08:00:00', 'to_time' => '18:00:00']);
        Rates::create(['title' => 'Night rate', 'from_time' => '18:00:00', 'to_time' => '08:00:00']);
    }
}
