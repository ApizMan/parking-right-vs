<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\UserAccess;
use Livewire\Component;

class ManageAccess extends Component
{
    public $datas;
    public $accessData;

    public function mount()
    {
        // Exclude users with the 'admin' role
        $this->datas = User::where('role', '!=', 'admin')->get();
        $this->accessData = UserAccess::all();
    }

    public function edit($userId)
    {
        // Fetch the user data based on $userId and populate the properties
        $user = User::find($userId);
    }

    public function render()
    {
        return view('livewire.admin.manage-access');
    }
}
