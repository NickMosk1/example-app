<div class="login-container">
    <h2>Вход в систему</h2>

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
        <button type="submit">Войти</button>
        <button id="home">На главную</button>
    </form>

    <script>
        document.getElementById('home').addEventListener('click', function() {
            window.location.href = '/';
        });
    </script>
    
    @include('customPages.loginPage.login-page-styles')
</div>