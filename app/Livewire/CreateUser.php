<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Partner;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateUser extends Component
{
    public $name;
    public $email;
    public $password;
    public $selectedRoles = [];
    public $selectedPartner = null;
    public $showPartnerSelect = false;

    public function render()
    {
        return view('customPages.createUserFormPage.create-user-form-page', [
            'roles' => Role::all(),
            'partners' => Partner::all(),
        ]);
    }

    public function toggleRole($roleName)
    {
        if (in_array($roleName, $this->selectedRoles)) {
            $this->selectedRoles = array_diff($this->selectedRoles, [$roleName]);
        } else {
            $this->selectedRoles[] = $roleName;
        }
        
        $this->showPartnerSelect = in_array('partner', $this->selectedRoles);
    }

    public function createUser()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'selectedRoles' => 'required|array|min:1',
            'selectedRoles.*' => 'exists:roles,name',
        ];

        if (in_array('partner', $this->selectedRoles)) {
            $rules['selectedPartner'] = 'required|exists:partners,id';
        }

        $this->validate($rules);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->syncRoles($this->selectedRoles);

        if (in_array('partner', $this->selectedRoles) && $this->selectedPartner) {
            $user->partners()->attach($this->selectedPartner);
        }

        $this->reset([
            'name', 'email', 'password',
            'selectedRoles', 'selectedPartner',
            'showPartnerSelect'
        ]);

        session()->flash('success', 'Пользователь успешно создан.');
    }
}