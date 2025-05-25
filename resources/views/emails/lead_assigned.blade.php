<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новая заявка!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: {{ $colors['GREEN'] }};
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .content {
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid {{ $colors['GREEN'] }};
            border-radius: 8px;
        }
        .logo {
            max-width: 200px;
            max-height: 200px;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .content p {
            margin: 10px 0;
            text-align: center;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: {{ $colors['GREEN'] }};
            color: {{ $colors['WHITE'] }};
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }
        .button:hover {
            background-color: {{ $colors['GREEN_HOVER'] }};
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: {{ $colors['DARK_GRAY'] }};
        }
        .status-container {
            margin: 15px 0;
            text-align: center;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 5px;
            color: {{ $colors['WHITE'] }};
            font-weight: bold;
            font-size: 14px;
        }
        .status-pending { background-color: {{ $colors['ORANGE'] }}; }
        .status-in_progress { background-color: {{ $colors['BLUE'] }}; }
        .status-sold_to_partner { background-color: {{ $colors['GREEN'] }}; }
        .status-cancelled { background-color: {{ $colors['RED'] }}; }
    </style>
</head>
<body>
    <div class="content">
        <img src="{{ $message->embed(public_path('additional/logo.JPG')) }}" alt="Логотип компании" class="logo">
        <h2>Новая заявка от {{ $lead->leadSource->name }}!</h2>
        <p><strong>Синопсис:</strong> {{ $lead->type }}</p>
        
        <div class="status-container">
            <strong>Статус:</strong> 
            <span class="status-badge status-{{ $lead->status }}">
                @switch($lead->status)
                    @case('pending')
                        В ожидании
                    @break
                    @case('in_progress')
                        В работе
                    @break
                    @case('sold_to_partner')
                        Продана партнеру
                    @break
                    @case('cancelled')
                        Отменена
                    @break
                @endswitch
            </span>
        </div>
        
        <p><strong>Количество:</strong> {{ $lead->quantity }}</p>
        <p><strong>Цена покупки для вас:</strong> {{ $lead->sale_price }} рублей</p>
        
        <div>
            <a href="http://example-app/" class="button">Перейти на сайт компании</a>
        </div>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} Peredai-ka. Все права защищены.</p>
        <p>
            <small>
                Это письмо отправлено автоматически. Пожалуйста, не отвечайте на него.
            </small>
        </p>
    </div>
</body>
</html>