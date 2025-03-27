<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Account extends Component
{
    public $user;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $successMessage = null;

    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function updateAccount()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user->id)
            ],
            'password' => 'nullable|min:6|confirmed'
        ]);

        $updateData = [
            'name' => $this->name,
            'email' => $this->email
        ];

        if ($this->password) {
            $updateData['password'] = bcrypt($this->password);
        }

        $this->user->update($updateData);

        $this->successMessage = 'Данные успешно обновлены!';
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function render()
    {
        return view('customPages.accountPage.account-page', [
            'user' => $this->user
        ])->layout('components.layouts.customLayout.custom-layout', [
            'title' => 'Личный кабинет'
        ]);
    }
}