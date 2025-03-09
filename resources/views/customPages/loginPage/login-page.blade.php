<div class="login-container">

    <div class="login-image-container">
        <img class="login-image" src="{{ asset('additional/login.JPG') }}" alt="Логин-панель">
    </div>

    <div class="login-title">Вход в систему</div>

    @if (session()->has('error'))
        <div class="error-message">{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent="login">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" wire:model="email" required>
        </div>
        <div>
            <label for="password">Пароль:</label>
            <input type="password" id="password" wire:model="password" required>
        </div>
        <button class="login-button" type="submit">Войти</button>
        <button class="home-button" id="home">На главную</button>
    </form>

    <script>
        document.getElementById('home').addEventListener('click', function() {
            window.location.href = '/';
        });
        document.querySelectorAll('.login-button').forEach(button => {
            button.addEventListener('mouseover', function() {
                document.querySelector('.login-image').classList.add('hovered');
                document.querySelector('.login-title').classList.add('hovered');
            });
            button.addEventListener('mouseout', function() {
                document.querySelector('.login-image').classList.remove('hovered');
                document.querySelector('.login-title').classList.remove('hovered');
            });
        });
    </script>
    
    @include('customPages.loginPage.login-page-styles')
</div>