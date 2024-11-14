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
            // Set an expiration time for the remember token (e.g., 30 days)
            if ($this->remember) {
                Session::put('remember_expiration', Carbon::now()->addDays(30));
            }
            // Redirect to dashboard or intended page
            return redirect()->route('admin.dashboard');
        }

        // Handle login failure
        session()->flash('error', 'Invalid credentials');

    }
    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
