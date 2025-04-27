<div class="partner-creation-container">
    <div class="create-partner-image-container">
        <img class="create-partner-image" src="{{ asset('additional/register.JPG') }}" alt="Панель-создания-партнера">
    </div>
    
    <div class="create-partner-title">Панель создания партнера</div>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="createPartner">
        <div>
            <label for="name">Имя:</label>
            <input type="text" id="name" wire:model="name" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" wire:model="email" required>
        </div>
        <div>
            <label for="phone">Телефон:</label>
            <input type="text" id="phone" wire:model="phone" required>
        </div>

        <button class="create-partner-button" type="submit">Создать партнера</button>
        <button type="button" class="home-button" onclick="window.location.href='/'">На главную</button>
    </form>

    <script>
        document.getElementById('home').addEventListener('click', function() {
            window.location.href = '/';
        });
        document.querySelectorAll('.create-partner-button').forEach(button => {
            button.addEventListener('mouseover', function() {
                document.querySelector('.create-partner-image').classList.add('hovered');
                document.querySelector('.create-partner-title').classList.add('hovered');
            });
            button.addEventListener('mouseout', function() {
                document.querySelector('.create-partner-image').classList.remove('hovered');
                document.querySelector('.create-partner-title').classList.remove('hovered');
            });
        });
    </script>

    @include('customPages.createPartnerPage.create-partner-page-styles')
</div>