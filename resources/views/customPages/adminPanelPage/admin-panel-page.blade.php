<div class="admin-panel-container">
    <div class="admin-panel-image-container">
        <img class="admin-panel-image" src="{{ asset('additional/adminPanel.JPG') }}" alt="Админ-панель">
    </div>

    <div class="admin-panel-title">Админ-панель</div>

    <div class="admin-dashboard">
        @php
            $user = auth()->user();
            $showUsersTable = $user->hasRole('manager');
            $showCreateUser = $user->hasRole('manager');
            $showLeadsTable = $user->hasRole('manager');
            $showPartnersLeadsTable = $user->hasRole('partner');
            $showCreateLead = $user->hasRole('manager') || $user->hasRole('applicant');
            $showLeadSourcesTable = $user->hasRole('manager');
            $showCreateLeadSource = $user->hasRole('manager');
            $showPartnersTable = $user->hasRole('manager');
            $showCreatePartner = $user->hasRole('manager');
        @endphp
        
        @if($showUsersTable || $showCreateUser)
        <div class="admin-panel user-panel">
            <h3 class="admin-panel-title">Пользователи</h3>
            <div class="button-group">
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
            </div>
        </div>
        @endif

        @if($showLeadsTable || $showCreateLead)
        <div class="admin-panel lead-panel">
            <h3 class="admin-panel-title">Заявки</h3>
            <div class="button-group">
                @if($showLeadsTable)
                    <button class="admin-button" onclick="location.href='/leads/table'">
                        Таблица заявок
                    </button>
                @endif
                @if($showCreateLead)
                    <button class="admin-button" onclick="location.href='/leads/create'">
                        Создать заявку
                    </button>
                @endif
            </div>
        </div>
        @endif

        @if($showLeadSourcesTable || $showCreateLeadSource)
        <div class="admin-panel source-panel">
            <h3 class="admin-panel-title">Источники</h3>
            <div class="button-group">
                @if($showLeadSourcesTable)
                    <button class="admin-button" onclick="location.href='/leads/sources/table'">
                        Таблица источников
                    </button>
                @endif
                @if($showCreateLeadSource)
                    <button class="admin-button" onclick="location.href='/leads/sources/create'">
                        Создать источник
                    </button>
                @endif
            </div>
        </div>
        @endif

        @if($showPartnersTable || $showCreatePartner)
        <div class="admin-panel partner-panel">
            <h3 class="admin-panel-title">Партнеры</h3>
            <div class="button-group">
                @if($showPartnersTable)
                    <button class="admin-button" onclick="location.href='/partners/table'">
                        Таблица партнеров
                    </button>
                @endif
                @if($showCreatePartner)
                    <button class="admin-button" onclick="location.href='/partners/create'">
                        Создать партнера
                    </button>
                @endif
            </div>
        </div>
        @endif

        @if($showPartnersLeadsTable)
        <div class="admin-panel partner-panel">
            <h3 class="admin-panel-title">Мои заявки</h3>
            <div class="button-group">
                @if($showPartnersLeadsTable)
                    <button class="admin-button" onclick="location.href='/leads/table/byPartner'">
                        Таблица заявок
                    </button>
                @endif
            </div>
        </div>
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