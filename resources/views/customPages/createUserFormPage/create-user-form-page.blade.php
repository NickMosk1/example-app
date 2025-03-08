<div class="user-creation-container">
    @if (session()->has('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form wire:submit="createUser">
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

        <button type="submit">Создать пользователя</button>
        <button id="home">На главную</button>
    </form>

    <script>
        document.getElementById('home').addEventListener('click', function() {
            window.location.href = '/';
        });
    </script>

    @include('customPages.createUserFormPage.create-user-form-page-styles')
</div>