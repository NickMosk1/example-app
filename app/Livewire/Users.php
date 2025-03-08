<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $perPage = 25;

    public function render()
    {
        $users = User::paginate($this->perPage);
        return view('customPages.usersTablePage.users-table-page', [
            'users' => $users,
        ])->layout('components.layouts.customLayout.custom-layout');
    }
}
