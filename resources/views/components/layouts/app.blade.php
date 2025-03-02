<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'ООО САМАРА-СТРОЙ' }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Montserrat:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #007BFF;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        header .logo {
            display: flex;
            align-items: center;
        }

        header .logo img {
            height: 60px;
            width: 60px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

        header .logo span {
            font-size: 1.5em;
            font-weight: bold;
            font-family: 'Montserrat', sans-serif;
        }

        header .profile-buttons {
            display: flex;
            gap: 15px;
        }

        header .profile-buttons button {
            background-color: transparent;
            border: none;
            color: white;
            font-size: 1.2em;
            cursor: pointer;
            position: relative;
        }

        header .profile-buttons button:hover {
            opacity: 0.8;
        }

        header .profile-buttons button .tooltip {
            visibility: hidden;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
        }

        header .profile-buttons button:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: auto;
        }

        footer p {
            margin: 5px 0;
        }

        .content {
            flex: 1;
            padding: 20px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('additional/logo.JPG') }}" alt="Логотип">
            <span>SamaraStroy</span>
        </div>
        <div class="profile-buttons">
            <button>
                <i class="fas fa-user"></i>
                <span class="tooltip">Профиль</span>
            </button>
            <button>
                <i class="fas fa-sign-out-alt"></i>
                <span class="tooltip">Выйти</span>
            </button>
        </div>
    </header>

    <div class="content">
        {{ $slot }}
    </div>

    <footer>
        <p>Телефон: +228 228 228</p>
        <p>Email: samaraStroy@gmail.com</p>
        <p>&copy; 2025 ООО САМАРА-СТРОЙ. Все права защищены.</p>
    </footer>
</body>
</html>
