<div>
    @if (session()->has('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    @if (session()->has('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    <p>Кол-во пользователей в БД: {{ $users->total() }}</p>

    <form wire:submit="createUser">
        <div style="margin-bottom: 15px;">
            <label for="name">Имя:</label>
            <input type="text" id="name" wire:model="name" required style="width: 500px; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; transition: border 0.3s, box-shadow 0.3s;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="email">Email:</label>
            <input type="email" id="email" wire:model="email" required style="width: 500px; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; transition: border 0.3s, box-shadow 0.3s;">
        </div>
        <div style="margin-bottom: 15px;">
            <label for="password">Пароль:</label>
            <input type="password" id="password" wire:model="password" required style="width: 500px; padding: 8px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; transition: border 0.3s, box-shadow 0.3s;">
        </div>
        <button type="submit" style="padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">Создать пользователя</button>
    </form>

    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Дата регистрации</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d.m.Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('customPages.usersTablePage.users-table-page-styles')
</div>