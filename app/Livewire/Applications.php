<?php

namespace App\Livewire;

use App\Models\Application;
use Livewire\Component;
use Livewire\WithPagination;

class Applications extends Component
{
    use WithPagination;

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $comment;
    public $perPage = 5; // Количество записей на странице по умолчанию

    public function render()
    {
        $applications = Application::paginate($this->perPage);
        return view('livewire.applications', [
            'applications' => $applications,
        ]);
    }

    public function submitApplication()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'comment' => 'nullable|string',
        ]);

        Application::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'comment' => $this->comment,
        ]);

        // Сброс полей формы после создания
        $this->reset(['first_name', 'last_name', 'email', 'phone', 'comment']);

        session()->flash('success', 'Заявка успешно отправлена.');
    }
}