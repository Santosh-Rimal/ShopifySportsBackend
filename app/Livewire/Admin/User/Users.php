<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class Users extends Component
{
    public function render()
    {
        
         $users = User::paginate(10); // Adjust the number as needed

        return view('livewire.admin.user.user',compact('users'));
    }
}