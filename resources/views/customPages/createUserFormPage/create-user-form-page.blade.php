<div class="user-creation-container">

    <div class="create-user-image-container">
        <img class="create-user-image" src="{{ asset('additional/register.JPG') }}" alt="Панель-регистрации">
    </div>
    
    <div class="create-user-title">Панель регистрации</div>

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

        <button class="create-user-button" type="submit">Создать пользователя</button>
        <button class="home-button" id="home">На главную</button>
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