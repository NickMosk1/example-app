<div class="user-creation-container">
    <div class="create-user-image-container">
        <img class="create-user-image" src="{{ asset('additional/register.JPG') }}" alt="Панель-создания-пользователя">
    </div>
    
    <div class="create-user-title">Панель создания пользователя</div>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="createUser">
        <div>
            <label for="name">Имя:</label>
            <input type="text" id="name" wire:model="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" wire:model="email" required>
        </div>
        <div>
            <label for="password">Пароль:</label>
            <input type="password" id="password" wire:model="password" required>
        </div>
        
        <div class="roles-selection">
            <label>Роли пользователя:</label>
            <div class="roles-container">
                @foreach($roles as $role)
                    <div class="role-option">
                        <input 
                            type="checkbox" 
                            id="role-{{ $role->id }}" 
                            wire:model="selectedRoles" 
                            value="{{ $role->name }}"
                            class="role-checkbox"
                        >
                        <label for="role-{{ $role->id }}" class="role-label">
                            {{ ucfirst($role->name) }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('selectedRoles')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button class="create-user-button" type="submit">Создать пользователя</button>
        <button type="button" class="home-button" onclick="window.location.href='/'">На главную</button>
    </form>

    <script>
        document.getElementById('home').addEventListener('click', function() {
            window.location.href = '/';
        });
        document.querySelectorAll('.create-user-button').forEach(button => {
            button.addEventListener('mouseover', function() {
                document.querySelector('.create-user-image').classList.add('hovered');
                document.querySelector('.create-user-title').classList.add('hovered');
            });
            button.addEventListener('mouseout', function() {
                document.querySelector('.create-user-image').classList.remove('hovered');
                document.querySelector('.create-user-title').classList.remove('hovered');
            });
        });
    </script>

    @include('customPages.createUserFormPage.create-user-form-page-styles')
</div>