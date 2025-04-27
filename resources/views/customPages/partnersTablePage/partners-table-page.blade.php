<div>
    <div class="partners-amount">Количество партнеров: {{ $partners->total() }}</div>

    <table class="partner-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Количество заявок</th>
                <th>Дата регистрации</th>
                <th>Обновлен</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody wire:poll.1000ms>
            @foreach($partners as $partner)
                <tr>
                    <td>{{ $partner->id }}</td>
                    <td>{{ $partner->name }}</td>
                    <td>{{ $partner->email }}</td>
                    <td>{{ $partner->phone }}</td>
                    <td>{{ $partner->leads_count }}</td>
                    <td>{{ $partner->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $partner->updated_at->format('d.m.Y H:i') }}</td>
                    <td class="actions-cell">
                        <div class="record-button-container">
                            <button class="btn-edit" wire:click="edit({{ $partner->id }})">
                                <img class="edit-image" src="{{ asset('additional/edit3.JPG') }}" alt="Редактирование">
                            </button>
                            <button class="btn-delete" wire:click="confirmDelete({{ $partner->id }})">
                                <img class="delete-image" src="{{ asset('additional/delete2.JPG') }}" alt="Удаление">
                            </button> 
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $partners->links() }}

    @if($showEditModal)
        <div class="modal-overlay">
            <div class="modal-content">
                <div class="modal-image-container">
                    <img class="modal-image" src="{{ asset('additional/account.JPG') }}" alt="Редактирование партнера">
                </div>
                
                <div class="modal-title">Редактирование партнера #{{ $editingPartnerId }}</div>

                @if (session()->has('modal_success'))
                    <div class="success">{{ session('modal_success') }}</div>
                @endif
                @if (session()->has('modal_error'))
                    <div class="error">{{ session('modal_error') }}</div>
                @endif

                <form wire:submit.prevent="update">
                    <div>
                        <label for="modal_name">Название:</label>
                        <input type="text" id="modal_name" wire:model="name" required>
                        @error('name') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="modal_email">Email:</label>
                        <input type="email" id="modal_email" wire:model="email" required>
                        @error('email') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="modal_phone">Телефон:</label>
                        <input type="tel" id="modal_phone" wire:model="phone">
                        @error('phone') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="modal-actions">
                        <button class="modal-save-button" type="submit">Сохранить</button>
                        <button class="modal-cancel-button" type="button" wire:click="closeModal">Отмена</button>
                    </div>
                </form>

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
            </div>
        </div>
    @endif

    @include('customPages.partnersTablePage.partners-table-page-styles')
</div>