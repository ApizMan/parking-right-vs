<?php

namespace App\Http\Controllers;

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

        return redirect()->route('admin.login');
    }

    public function logout()
    {
        // Log out the user
        Auth::logout();

        // Clear the remember token expiration
        Session::forget('remember_expiration');

        // Redirect to the login page
        return redirect()->route('auth.login');
    }
}
