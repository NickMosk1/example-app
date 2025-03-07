<div>
    <div>
        @if (session()->has('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif
        @if (session()->has('error'))
            <div style="color: red;">{{ session('error') }}</div>
        @endif

        <p>Кол-во пользователей в БД: {{ $users->total() }}</p>

        <!-- Форма для создания новых пользователей -->
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

        <!-- Таблица пользователей -->
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

        <!-- Пагинация -->
        <div style="margin-top: 20px; display: flex; justify-content: center; align-items: center;">
            <label for="perPage">Записей на странице:</label>
            <select id="perPage" wire:model="perPage" style="margin-left: 10px; padding: 5px; border-radius: 5px; border: 1px solid #ccc;">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
            </select>
            {{ $users->links() }}
        </div>

        <style>
            .user-table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                overflow: hidden;
                font-family: 'Montserrat', sans-serif;
            }

            .user-table thead {
                background-color: #007BFF;
                color: white;
                font-weight: bold;
            }

            .user-table th, .user-table td {
                padding: 12px;
                text-align: left;
            }

            .user-table tbody tr {
                background-color: #f9f9f9;
                transition: background-color 0.3s ease;
            }

            .user-table tbody tr:hover {
                background-color: #e0f7fa;
            }

            .user-table tbody tr:nth-child(even) {
                background-color: #e9ecef;
            }

            input:focus, select:focus {
                border: 1px solid #007BFF;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
                outline: none;
            }

            .pagination {
                display: flex;
                gap: 5px;
            }

            .pagination a {
                padding: 10px 15px;
                background-color: #007BFF;
                color: white;
                border-radius: 5px;
                text-decoration: none;
                transition: background-color 0.3s;
            }

            .pagination a:hover {
                background-color: #0056b3;
            }

            .pagination .active {
                background-color: #0056b3;
                font-weight: bold;
            }

            .pagination .disabled, .pagination .disabled:hover {
                background-color: #ccc;
                cursor: not-allowed;
            }
        </style>
    </div>
</div>
