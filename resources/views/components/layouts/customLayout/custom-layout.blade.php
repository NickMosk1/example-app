<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'ООО ПЕРЕДАЙ-КА' }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Montserrat:wght@400;700&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        @include('components.layouts.customLayout.custom-layout-styles')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body>
        <header>
            <div class="logo">
                <img src="{{ asset('additional/logo.JPG') }}" alt="Логотип">
                <span> ПЕРЕДАЙ-КА </span>
            </div>
            <div class="profile-buttons">

            </div>
        </header>

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
