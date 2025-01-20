<?php

namespace App\Http\Controllers;

use App\Models\ParkingRight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ParkingRightController extends Controller
{
    function index()
    {
        if (Auth::user()->role == 'user') {
            return view('parking_right');
        }

        return redirect()->route('auth.login');
    }
}
