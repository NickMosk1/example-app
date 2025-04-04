<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Lead;
use Livewire\WithPagination;

class LeadsTable extends Component
{
    use WithPagination;

    // Публичные свойства
    public $showEditModal = false; // Для отображения модального окна
    public $editingLeadId = null;  // ID редактируемой заявки
    public $full_name;             // ФИО заявителя
    public $quantity;              // Количество продуктов
    public $type;                  // Описание продукта
    public $status;                // Статус заявки
    public $countLeads;
    // Метод для редактирования
    public function edit($leadId)
    {
        $lead = Lead::findOrFail($leadId);
        
        $this->editingLeadId = $leadId; // Устанавливаем ID редактируемой заявки
        $this->full_name = $lead->full_name;
        $this->quantity = $lead->quantity;
        $this->type = $lead->type;
        $this->status = $lead->status;
        
        $this->showEditModal = true; // Показываем модальное окно
    }

    // Метод для обновления заявки
    public function update()
    {
        // Валидация данных
        $this->validate([
            'full_name' => 'required|min:3',
            'quantity' => 'required|integer|min:1',
            'type' => 'required|min:5',
            'status' => 'required|in:pending,in_progress,sold_to_partner,cancelled',
        ]);

        // Обновляем заявку
        Lead::find($this->editingLeadId)->update([
            'full_name' => $this->full_name,
            'quantity' => $this->quantity,
            'type' => $this->type,
            'status' => $this->status,
        ]);

        // Закрываем модальное окно и сбрасываем данные
        $this->showEditModal = false;
        session()->flash('message', 'Заявка успешно обновлена');
    }

    // Метод для удаления заявки
    public function confirmDelete($leadId)
    {
        $lead = Lead::find($leadId);

        if ($lead) {
            $lead->delete();
            session()->flash('message', 'Заявка успешно удалена');
        } else {
            session()->flash('error', 'Заявка не найдена');
        }
    }

    // Метод для закрытия модального окна
    public function closeModal()
    {
        $this->showEditModal = false;
        $this->editingLeadId = null;
        $this->reset(['full_name', 'quantity', 'type', 'status']); // Сбрасываем поля формы
        $this->resetValidation(); // Сбрасываем ошибки валидации
    }


    public function render()
    {
        $leads = Lead::paginate(20);
        
        return view('customPages.leadsTablePage.leads-table-page', [
            'leads' => $leads,
        ])->layout('components.layouts.customLayout.custom-layout');
    }

    public function getCountLeads(){
        
        $this->countLeads =  Lead::query()->count();
    }

    // public function sendMail(){
    //     Mail::
    // }
}