<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCards extends Model
{
    public $timestamps = false;

    protected $table = 'discount_cards';
    protected $primaryKey = 'id';

    protected $fillable = [
        'key',
        'title',
        'discount_percentage',
    ];

}
