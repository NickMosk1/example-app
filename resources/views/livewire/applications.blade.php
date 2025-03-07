<div>
    <!-- Форма подачи заявки -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <h2 class="text-2xl font-bold mb-6">Форма подачи заявки</h2>
        <form wire:submit.prevent="submitApplication">
            <!-- Имя -->
            <div class="mb-4">
                <label for="first-name" class="block text-sm font-medium text-gray-700">Имя</label>
                <input
                    type="text"
                    id="first-name"
                    wire:model="first_name"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Введите ваше имя"
                />
            </div>

            <!-- Фамилия -->
            <div class="mb-4">
                <label for="last-name" class="block text-sm font-medium text-gray-700">Фамилия</label>
                <input
                    type="text"
                    id="last-name"
                    wire:model="last_name"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Введите вашу фамилию"
                />
            </div>

            <!-- Почта -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Почта</label>
                <input
                    type="email"
                    id="email"
                    wire:model="email"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Введите вашу почту"
                />
            </div>

            <!-- Телефон -->
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Телефон</label>
                <input
                    type="tel"
                    id="phone"
                    wire:model="phone"
                    required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Введите ваш телефон"
                />
            </div>

            <!-- Комментарий -->
            <div class="mb-6">
                <label for="comment" class="block text-sm font-medium text-gray-700">Комментарий</label>
                <textarea
                    id="comment"
                    wire:model="comment"
                    rows="4"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Введите ваш комментарий"
                ></textarea>
            </div>

            <!-- Кнопка отправки -->
            <div>
                <button
                    type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    Отправить заявку
                </button>
            </div>
        </form>
    </div>

    <!-- Таблица заявок -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6">Список заявок</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Имя</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Фамилия</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Почта</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Телефон</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Комментарий</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($applications as $application)
                    <tr>
                        <td class="px-6 py-4">{{ $application->first_name }}</td>
                        <td class="px-6 py-4">{{ $application->last_name }}</td>
                        <td class="px-6 py-4">{{ $application->email }}</td>
                        <td class="px-6 py-4">{{ $application->phone }}</td>
                        <td class="px-6 py-4">{{ $application->comment }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Пагинация -->
        <div class="mt-4">
            {{ $applications->links() }}
        </div>
    </div>
</div>