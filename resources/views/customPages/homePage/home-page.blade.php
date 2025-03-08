<div class="container">

    <div class="authorization-quote">Войдите в имеющийся аккаунт, или зарегистрируйте новый</div>

    <div class="header-buttons">
        <button class="btn" onclick="location.href='/login'">Вход</button>
        <button class="btn" onclick="location.href='/register'">Регистрация</button>
    </div>

    <div class="about-company">МЫ — это:</div>

    <div class="cards">
        <div class="card">
            <img src="{{ asset('additional/currencies.JPG') }}" alt="Валюты">
            <div class="card-content">
                <h3 class="card-title">Работа с валютами</h3>
                <p class="card-text">Мы поддерживаем различные валюты для удобства наших клиентов и партнеров.</p>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('additional/globe.JPG') }}" alt="Глобальность">
            <div class="card-content">
                <h3 class="card-title">Глобальное покрытие</h3>
                <p class="card-text">Наши услуги доступны по всему миру, обеспечивая глобальное взаимодействие.</p>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('additional/speed.JPG') }}" alt="Брендинг">
            <div class="card-content">
                <h3 class="card-title">Сильный бренд</h3>
                <p class="card-text">Наш бренд известен своей надежностью и качеством обслуживания.</p>
            </div>
        </div>
        <div class="card">
            <img src="{{ asset('additional/partners.JPG') }}" alt="Партнерство">
            <div class="card-content">
                <h3 class="card-title">Партнерская сеть</h3>
                <p class="card-text">Мы сотрудничаем с лучшими компаниями для обеспечения высокого уровня сервиса.</p>
            </div>
        </div>
    </div>

    @include('customPages.homePage.home-page-styles')
</div>