<?php

namespace App\Models;

use Carbon\Carbon;
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

    /**
     * Accessor for serverDate in d-m-Y format.
     */
    public function getEventDateAttribute()
    {
        return Carbon::parse($this->attributes['event_date'])->format('d-m-Y');
    }

    /**
     * Accessor for serverTime in H:i:s format.
     */
    public function getEventTimeAttribute()
    {
        return Carbon::parse($this->attributes['event_date'])->format('h:i:s A');
    }
}
