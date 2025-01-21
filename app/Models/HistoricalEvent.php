<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricalEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'description',
        'department_involved',
        'staff_involved',
        'zone_area',
        'event_date'
    ];
}
