<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingRight extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'parking_id',
        'plate_number',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'paid_amount',
        'creation_date',
        'creation_time',
        'zone',
        'terminal',
        'transaction_no'
    ];

    /**
     * Accessor for serverDate in d-m-Y format.
     */
    public function getServerDateAttribute()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }

    /**
     * Accessor for serverTime in H:i:s format.
     */
    public function getServerTimeAttribute()
    {
        return Carbon::parse($this->created_at)->format('h:i:s A');
    }
}
