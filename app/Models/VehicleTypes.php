<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleTypes extends Model
{
    public $timestamps = false;

    protected $table = 'vehicle_types';
    protected $primaryKey = 'id';

    protected $fillable = [
        'key',
        'title',
        'parking_slots',
    ];

}
