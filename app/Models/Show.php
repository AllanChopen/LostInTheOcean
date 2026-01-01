<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    protected $table = 'shows';

    protected $fillable = [
        'title',
        'country',
        'city',
        'venue',
        'venue_address',
        'date',
        'start_time',
        'description',
        'poster_image',
        'status',
        'base_price',
        'currency',
        'is_free',
        'google_maps_link',
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime:H:i:s',
        'base_price' => 'decimal:2',
        'is_free' => 'boolean',
    ];
}
