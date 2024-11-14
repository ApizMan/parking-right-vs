<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    function index()
    {
        return view('admin.dashboard');
    }

    public function logout()
    {
        // Log out the user
        Auth::logout();

        // Clear the remember token expiration
        Session::forget('remember_expiration');

        // Redirect to the login page
        return redirect()->route('admin.login');
    }
}
