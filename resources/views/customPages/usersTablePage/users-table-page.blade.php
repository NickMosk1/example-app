<div>
    <div class="users-amount">Число зарегистрированных пользователей: {{ $users->total() }}</div>

    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Роли</th>
                <th>Дата регистрации</th>
                <th>Обновлен</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="roles-cell">
                        @foreach($user->roles as $role)
                            <span class="role-chip role-{{ str_replace(' ', '_', strtolower($role->name)) }}">
                                {{ $role->name }}
                            </span>
                        @endforeach
                    </td>
                    <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $user->updated_at->format('d.m.Y H:i') }}</td>
                    <td class="actions-cell">
                        <div class="record-button-container">
                            <button class="btn-edit" wire:click="edit({{ $user->id }})">
                                <img class="edit-image" src="{{ asset('additional/edit3.JPG') }}" alt="Редактирование">
                            </button>
                            <button class="btn-delete" wire:click="confirmDelete({{ $user->id }})">
                                <img class="delete-image" src="{{ asset('additional/delete2.JPG') }}" alt="Удаление">
                            </button> 
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}

    @if($showEditModal)
        <div class="modal-overlay">
            <div class="modal-content">
                <div class="modal-image-container">
                    <img class="modal-image" src="{{ asset('additional/account.JPG') }}" alt="Редактирование пользователя">
                </div>
                
                <div class="modal-title">Редактирование пользователя #{{ $editingUserId }}</div>

                @if (session()->has('modal_success'))
                    <div class="success">{{ session('modal_success') }}</div>
                @endif
                @if (session()->has('modal_error'))
                    <div class="error">{{ session('modal_error') }}</div>
                @endif

                <form wire:submit.prevent="update">
                    <div>
                        <label for="modal_name">Имя:</label>
                        <input type="text" id="modal_name" wire:model="name" required>
                        @error('name') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="modal_email">Email:</label>
                        <input type="email" id="modal_email" wire:model="email" required>
                        @error('email') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="roles-selection">
                        <label>Роли пользователя:</label>
                        <div class="roles-container">
                            @foreach($allRoles as $role)
                                <div class="role-option">
                                    <input 
                                        type="checkbox" 
                                        id="role-{{ $role->name }}" 
                                        wire:model="selectedRoles" 
                                        value="{{ $role->name }}"
                                        class="role-checkbox"
                                    >
                                    <label for="role-{{ $role->name }}" class="role-label">
                                        {{ ucfirst($role->name) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('selectedRoles') 
                            <div class="error-message">{{ $message }}</div> 
                        @enderror
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

    

    @include('customPages.usersTablePage.users-table-page-styles')
</div>