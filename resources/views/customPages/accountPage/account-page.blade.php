<div class="account-container">
    <div class="account-image-container">
        <img class="account-image" src="{{ asset('additional/account.JPG') }}" alt="Аккаунт">
    </div>
    
    <div class="account-title">Мой аккаунт</div>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('account.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div>
            <label for="password">Новый пароль:</label>
            <input type="password" id="password" name="password">
        </div>

        <div>
            <label for="password_confirmation">Подтвердите пароль:</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="account-button">Сохранить изменения</button>
        <button type="button" class="home-button" onclick="window.location.href='/'">На главную</button>
    </form>

    <script>
        document.querySelector('.account-button').addEventListener('mouseover', function() {
            document.querySelector('.account-image').classList.add('hovered');
            document.querySelector('.account-title').classList.add('hovered');
        });
        
        document.querySelector('.account-button').addEventListener('mouseout', function() {
            document.querySelector('.account-image').classList.remove('hovered');
            document.querySelector('.account-title').classList.remove('hovered');
        });
    </script>

    @include('customPages.accountPage.account-page-styles')
</div>