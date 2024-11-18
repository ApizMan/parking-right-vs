<?php

namespace App\Livewire\Admin\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class Login extends Component
{
    public $email = '';

    public $password = '';

    public $remember = false;

    public function save()
    {
        $validated = $this->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = ['email' => $this->email, 'password' => $this->password];

        if (Auth::attempt($credentials, $this->remember)) {
            $user = Auth::user();

            // Check if the user has the admin role
            if ($user->role == 'admin') {
                // Set an expiration time for the remember token (e.g., 30 days)
                if ($this->remember) {
                    Session::put('remember_expiration', Carbon::now()->addDays(30));
                }

                // Redirect to dashboard or intended page
                return redirect()->route('admin.dashboard');
            }

            // Logout and flash error message if not an admin
            Auth::logout();
            session()->flash('error', 'Access denied. Admin only.');
            return redirect()->route('admin.login');
        }

        // Handle login failure
        session()->flash('error', 'Invalid credentials');
    }

    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
