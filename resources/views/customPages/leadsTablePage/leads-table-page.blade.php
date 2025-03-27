<div>
    <table class="lead-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>ФИО заявителя</th>
                <th>Количество</th>
                <th>Описание</th>
                <th>Статус</th>
                <th>Создана</th>
                <th>Обновлена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leads as $lead)
                <tr>
                    <td>{{ $lead->id }}</td>
                    <td>{{ $lead->full_name }}</td>
                    <td>{{ $lead->quantity }}</td>
                    <td>{{ $lead->type }}</td>
                    <td class="status-cell">
                        <span class="status-badge status-{{ str_replace(' ', '_', strtolower($lead->status)) }}">
                            @switch($lead->status)
                                @case('pending')
                                    В ожидании
                                @break
                                @case('in_progress')
                                    В работе
                                @break
                                @case('sold_to_partner')
                                    Продана партнеру
                                @break
                                @case('cancelled')
                                    Отменена
                                @break
                                @default
                                    Неизвестный статус
                            @endswitch
                        </span>
                    </td>
                    <td>{{ $lead->created_at }}</td>
                    <td>{{ $lead->updated_at }}</td>
                    <td class="actions-cell">
                        <div class="record-button-container">
                            <button class="btn-edit" wire:click="edit({{ $lead->id }})">
                                <img class="edit-image" src="{{ asset('additional/edit3.JPG') }}" alt="Редактирование">
                            </button>
                            <button class="btn-delete" wire:click="confirmDelete({{ $lead->id }})">
                                <img class="delete-image" src="{{ asset('additional/delete2.JPG') }}" alt="Удаление">
                            </button> 
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $leads->links() }}

    @if($showEditModal)
        <div class="modal-overlay">
            <div class="modal-content">
                <div class="modal-image-container">
                    <img class="modal-image" src="{{ asset('additional/createLead.JPG') }}" alt="Редактирование заявки">
                </div>
                
                <div class="modal-title">Редактирование заявки #{{ $editingLeadId }}</div>

                @if (session()->has('modal_success'))
                    <div class="success">{{ session('modal_success') }}</div>
                @endif
                @if (session()->has('modal_error'))
                    <div class="error">{{ session('modal_error') }}</div>
                @endif

                <form wire:submit.prevent="update">
                    <div>
                        <label for="modal_full_name">ФИО заявителя:</label>
                        <input type="text" id="modal_full_name" wire:model="full_name" required>
                        @error('full_name') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="modal_quantity">Количество:</label>
                        <input type="number" id="modal_quantity" wire:model="quantity" required>
                        @error('quantity') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="modal_type">Тип:</label>
                        <textarea id="modal_type" wire:model="type" required></textarea>
                        @error('type') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="modal_status">Статус:</label>
                        <select id="modal_status" wire:model="status" required>
                            <option value="pending">В ожидании</option>
                            <option value="in_progress">В работе</option>
                            <option value="sold_to_partner">Продана партнеру</option>
                            <option value="cancelled">Отменена</option>
                        </select>
                        @error('status') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="modal-actions">
                        <button class="modal-save-button" type="submit">Сохранить</button>
                        <button class="modal-cancel-button" type="button" wire:click="closeModal">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('livewire:load', function() {
            const saveButton = document.querySelector('.modal-save-button');
            if (saveButton) {
                saveButton.addEventListener('mouseover', function() {
                    const image = document.querySelector('.modal-image');
                    const title = document.querySelector('.modal-title');
                    if (image) image.classList.add('hovered');
                    if (title) title.classList.add('hovered');
                });
                
                saveButton.addEventListener('mouseout', function() {
                    const image = document.querySelector('.modal-image');
                    const title = document.querySelector('.modal-title');
                    if (image) image.classList.remove('hovered');
                    if (title) title.classList.remove('hovered');
                });
            }
        });
    </script>

    @include('customPages.leadsTablePage.leads-table-page-styles')
</div>