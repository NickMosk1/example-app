<div>
    <!-- Таблица с заявками -->
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
                    <td>
                        <button class="btn-edit" wire:click="edit({{ $lead->id }})">
                            ✏️
                        </button>
                        <button class="btn-delete" wire:click="confirmDelete({{ $lead->id }})">
                            🗑️
                        </button> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Пагинация -->
    {{ $leads->links() }}

    <!-- Модальное окно редактирования -->
    @if($showEditModal)
        <div class="modal-overlay">
            <div class="modal-content">
                <h2>Редактирование заявки #{{ $editingLeadId }}</h2>
                <form wire:submit.prevent="update">
                    <!-- Поле: ФИО заявителя -->
                    <div class="form-group">
                        <label>ФИО заявителя:</label>
                        <input type="text" wire:model="full_name" class="form-control">
                        @error('full_name') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <!-- Поле: Количество продуктов -->
                    <div class="form-group">
                        <label>Количество продуктов:</label>
                        <input type="number" wire:model="quantity" class="form-control">
                        @error('quantity') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <!-- Поле: Описание продукта -->
                    <div class="form-group">
                        <label>Описание продукта:</label>
                        <textarea wire:model="type" class="form-control"></textarea>
                        @error('type') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <!-- Поле: Статус -->
                    <div class="form-group">
                        <label>Статус:</label>
                        <select wire:model="status" class="form-control">
                            <option value="pending">В ожидании</option>
                            <option value="in_progress">В работе</option>
                            <option value="sold_to_partner">Продана партнеру</option>
                            <option value="cancelled">Отменена</option>
                        </select>
                        @error('status') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <!-- Кнопки действий -->
                    <div class="modal-actions">
                        <button type="submit" class="btn-save">Сохранить</button>
                        <button type="button" class="btn-cancel" wire:click="closeModal">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @include('customPages.leadsTablePage.leads-table-page-styles')
</div>