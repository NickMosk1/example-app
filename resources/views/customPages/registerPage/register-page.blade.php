<div class="user-creation-container">
    <div class="create-user-image-container">
        <img class="create-user-image" src="{{ asset('additional/register.JPG') }}" alt="Регистрация">
    </div>
    
    <div class="create-user-title">Регистрация нового пользователя</div>

    @if (session()->has('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form wire:submit.prevent="register">
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
        <div>
            <label for="password_confirmation">Подтвердите пароль:</label>
            <input type="password" id="password_confirmation" wire:model="password_confirmation" required>
        </div>

        <button class="create-user-button" type="submit">Зарегистрироваться</button>
        <button type="button" class="home-button" onclick="window.location.href='/'">На главную</button>
    </form>

    <div class="login-link">
        Уже есть аккаунт? <a href="{{ route('login') }}">Войдите</a>
    </div>

    <script>
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

    @include('customPages.registerPage.register-page-styles')
</div>