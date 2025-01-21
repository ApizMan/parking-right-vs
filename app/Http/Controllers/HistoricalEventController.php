<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoricalEventController extends Controller
{
    function index()
    {
        if (Auth::user()->role == 'user') {
            return view('historical_event.dashboard_historical_event');
        }

        return redirect()->route('auth.login');
    }

    function create()
    {
        if (Auth::user()->role == 'user') {
            return view('historical_event.create_historical_event');
        }

        return redirect()->route('auth.login');
    }
}
