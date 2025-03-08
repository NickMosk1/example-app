<div class="login-container">
    <h2>Вход в систему</h2>

    @if (session()->has('error'))
        <div style="color: red;">{{ session('error') }}</div>
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
    </form>
</div>