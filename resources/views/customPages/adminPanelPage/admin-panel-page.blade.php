<div class="admin-panel-container">

    <div class="admin-panel-image-container">
        <img class="admin-panel-image" src="{{ asset('additional/adminPanel.JPG') }}" alt="Админ-панель">
    </div>

    <div class="admin-panel-title">Админ-панель</div>

    <div class="button-group">
        <button class="admin-button" onclick="location.href='/users/table'">
            Таблица пользователей
        </button>
        <button class="admin-button" onclick="location.href='/register'">
            Создать пользователя
        </button>
        <button class="admin-button" onclick="location.href='/leads/table'">
            Таблицы заявок
        </button>
        <button class="admin-button" onclick="location.href='/leads/create'">
            Создать заявку
        </button>
    </div>

    <script>
        document.querySelectorAll('.admin-button').forEach(button => {
            button.addEventListener('mouseover', function() {
                document.querySelector('.admin-panel-image').classList.add('hovered');
                document.querySelector('.admin-panel-title').classList.add('hovered');
            });
            button.addEventListener('mouseout', function() {
                document.querySelector('.admin-panel-image').classList.remove('hovered');
                document.querySelector('.admin-panel-title').classList.remove('hovered');
            });
        });
    </script>

    @include('customPages.adminPanelPage.admin-panel-page-styles')
</div>