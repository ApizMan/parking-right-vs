<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Str; // Add this line

class Dashboard extends Component
{
    public $datas;
    public $name = '';
    public $email = '';
    public $password = '';

    public $userId;

    public function mount()
    {
        // Exclude users with the 'admin' role
        $this->datas = User::where('role', '!=', 'admin')->get();
    }

    public function save()
    {
        // Validate the input data

        // dd();
        $validateData = $this->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'password' => 'required',
        ]);

        // If validation passes, create the user
        if ($validateData) {
            // Create a new user
            User::create([
                'name' => $validateData['name'],
                'email' => $validateData['email'],
                'password' => Hash::make($validateData['password']),
            ]);

            // Flash success message
            session()->flash('status', 'User created successfully!');

            // Reset input fields
            $this->reset(['name', 'email', 'password']);

            return redirect()->route('admin.dashboard');
        }
    }

    public function edit($userId)
    {
        // Fetch the user data based on $userId and populate the properties
        $user = User::find($userId);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->userId = $user->id;
    }

    public function update()
    {
        // Logic to update the user data
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::find($this->userId);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Flash success message
        session()->flash('status', 'User update successfully!');

        return redirect()->route('admin.dashboard');
    }

    public function delete($userId)
    {
        $user = User::find($userId);

        $user->delete();

        // Flash success message
        session()->flash('status', 'User delete successfully!');

        return redirect()->route('admin.dashboard');
    }

    public function resetPassword($userEmail)
    {
        // Ensure the email is valid
        $user = User::where('email', $userEmail)->first();

        if (!$user) {
            // Optionally handle user not found
            session()->flash('error', 'User not found!');
            return;
        }

        // Generate a random password
        $randomPassword = Str::random(10); // Adjust the length as needed

        // Update user password
        $user->update([
            'password' => Hash::make($randomPassword),
        ]);

        // Send the new password via email
        Mail::send('admin.auth.password-reset', ['password' => $randomPassword, 'email' => $userEmail], function ($message) use ($userEmail) {
            $message->to($userEmail)->subject('Your New Password');
        });

        // Flash success message
        session()->flash('status', 'Password successfully sent to user email!');

        return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
