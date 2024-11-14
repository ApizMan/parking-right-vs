<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{
    public $username = '';

    public $password = '';

    public function save()
    {
        $validated = $this->validate([
            'username' => 'required',
            'password' => 'required',
        ]);


    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
