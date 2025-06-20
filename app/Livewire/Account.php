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

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::id())
            ],
            'password' => 'nullable|min:6|confirmed'
        ];
    }

    public function mount()
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function updateAccount()
    {
        $this->validate();

        $updateData = [
            'name' => $this->name,
            'email' => $this->email
        ];

        if ($this->password) {
            $updateData['password'] = bcrypt($this->password);
        }

        $this->user->update($updateData);
        $this->successMessage = 'Данные успешно обновлены!';
        $this->reset(['password', 'password_confirmation']);
        
        Auth::setUser($this->user->fresh());
    }

    public function render()
    {
        return view('customPages.accountPage.account-page', [
            'user' => $this->user
        ]);
    }
}