<?php

namespace App\Livewire\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Login extends Component
{
    public $email = '';

    public $password = '';

    public $remember = false;

    public function save()
    {
        $this->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = ['email' => $this->email, 'password' => $this->password];

        if (Auth::attempt($credentials, $this->remember)) {
            $user = Auth::user();

            // Check if the user has the admin role
            if ($user->role == 'user') {
                // Set an expiration time for the remember token (e.g., 30 days)
                if ($this->remember) {
                    Session::put('remember_expiration', Carbon::now()->addDays(30));
                }

                // Redirect to dashboard or intended page
                return redirect()->route('auth.dashboard');
            }

            // Logout and flash error message if not an admin
            Auth::logout();
            session()->flash('error', 'Access denied. Please tell Admin to register account.');
            return redirect()->route('auth.login');
        }

        // Handle login failure
        session()->flash('error', 'Invalid credentials');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
