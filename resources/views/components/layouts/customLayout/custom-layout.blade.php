<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ 'ООО ПЕРЕДАЙ-КА' }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Montserrat:wght@400;700&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        @include('components.layouts.customLayout.custom-layout-styles')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </head>
    <body>
        <header>
            <div class="logo" id="logo-container">
                <img src="{{ asset('additional/logo.JPG') }}" alt="Логотип">
                <span> ПЕРЕДАЙ-КА </span>
            </div>
                @auth
                    <div class="account-info" id="account-info-container">
                        <span class="username">{{ Auth::user()->email }}</span>
                        <img src="{{ asset('additional/account.JPG') }}" alt="Аккаунт" class="account-icon">
                    </div>
                @endauth
        </header>

        <script>
            document.getElementById('logo-container').addEventListener('click', function() {
                window.location.href = '/';
            });
            document.getElementById('account-info-container').addEventListener('click', function() {
                window.location.href = '/account';
            });
        </script>

        <div class="content">
            {{ $slot }}
        </div>

        <footer>
            <p>Телефон: +7 987 654 321</p>
            <p>Email: peredai-ka@yandex.ru</p>
            <p>&copy; 2025 ООО «ПЕРЕДАЙ-КА». Все права защищены.</p>
        </footer>

        @livewireScripts
    </body>
</html>