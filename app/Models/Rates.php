<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rates extends Model
{
    public $timestamps = false;

    protected $table = 'rates';
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'from_time',
        'to_time',
    ];

}
