<div class="admin-panel-container">
    <div class="admin-panel-image-container">
        <img class="admin-panel-image" src="{{ asset('additional/adminPanel.JPG') }}" alt="Админ-панель">
    </div>

    <div class="admin-panel-title">Админ-панель</div>

    <div class="button-group">
        @php
            $user = auth()->user();
            $showUsersTable = $user->hasRole('manager');
            $showCreateUser = $user->hasRole('manager');
            $showLeadsTable = $user->hasRole('manager') || $user->hasRole('partner') || $user->hasRole('applicant');
            $showCreateLead = $user->hasRole('manager') || $user->hasRole('applicant');
            $showLeadSourcesTable = $user->hasRole('manager');
        @endphp

        @if($showUsersTable)
            <button class="admin-button" onclick="location.href='/users/table'">
                Таблица пользователей
            </button>
        @endif

        @if($showCreateUser)
            <button class="admin-button" onclick="location.href='/users/create'">
                Создать пользователя
            </button>
        @endif

        @if($showLeadsTable)
            <button class="admin-button" onclick="location.href='/leads/table'">
                Таблицы заявок
            </button>
        @endif

        @if($showCreateLead)
            <button class="admin-button" onclick="location.href='/leads/create'">
                Создать заявку
            </button>
        @endif

        @if($showLeadSourcesTable)
            <button class="admin-button" onclick="location.href='/leads/sources/table'">
                Таблица источников
            </button>
        @endif
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