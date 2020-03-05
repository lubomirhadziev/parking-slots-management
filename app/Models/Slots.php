<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slots extends Model
{
    public $timestamps = false;

    protected $table = 'slots';
    protected $primaryKey = 'id';

    public function vehicle_type()
    {
        return $this->hasOne('App\Models\VehicleTypes', 'id', 'vehicle_type_id');
    }

    public function discount_card()
    {
        return $this->hasOne('App\Models\DiscountCards', 'id', 'discount_card_id');
    }

}
