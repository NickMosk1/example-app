<div class="account-container">
    <div class="account-header">
        <div class="account-title">Мой аккаунт</div>
    </div>
    <div class="user-info">
        <form action="{{ route('account.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Имя:</label>
                <input type="text" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label>Новый пароль:</label>
                <input type="password" name="password">
            </div>

            <div class="form-group">
                <label>Подтвердите пароль:</label>
                <input type="password" name="password_confirmation">
            </div>

            <button type="submit" class="btn-save">Сохранить изменения</button>
        </form>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    @include('customPages.accountPage.account-styles')
</div>