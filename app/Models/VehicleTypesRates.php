<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleTypesRates extends Model
{
    public $timestamps = false;

    protected $table = 'vehicle_types_rates';
    protected $primaryKey = 'id';

    protected $fillable = [
        'vehicle_type_id',
        'rate_id',
        'amount_per_hour'
    ];

    public function vehicle_type()
    {
        return $this->hasOne('App\Models\VehicleTypes');
    }

    public function rate()
    {
        return $this->hasOne('App\Models\Rates');
    }

}
