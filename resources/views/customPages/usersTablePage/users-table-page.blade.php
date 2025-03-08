<div>
    <div class="users-amount">Число зарегистрированных пользователей: {{ $users->total() }}</div>

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