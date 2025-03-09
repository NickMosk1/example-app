<div class="create-lead-container">

    <div class="create-lead-image-container">
        <img class="create-lead-image" src="{{ asset('additional/createLead.JPG') }}" alt="Панель создания заявки">
    </div>
    
    <div class="create-lead-title">Панель создания заявки</div>

    @if (session()->has('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent="create">
        <div>
            <label for="full_name">ФИО заявителя:</label>
            <input type="text" id="full_name" wire:model="full_name" required>
        </div>
        <div>
            <label for="quantity">Количество:</label>
            <input type="number" id="quantity" wire:model="quantity" required>
        </div>
        <div>
            <label for="type">Тип:</label>
            <input type="text" id="type" wire:model="type" required>
        </div>
        <div>
            <label for="status">Статус:</label>
            <select id="status" wire:model="status" required>
                <option value="pending">В ожидании</option>
                <option value="in_progress">В работе</option>
                <option value="sold_to_partner">Продана партнеру</option>
                <option value="cancelled">Отменена</option>
            </select>
        </div>
        <button class="create-lead-button" type="submit">Создать заявку</button>
        <button class="home-button" id="home">На главную</button>
    </form>

     <script>
        document.getElementById('home').addEventListener('click', function() {
            window.location.href = '/';
        });
        document.querySelectorAll('.create-lead-button').forEach(button => {
            button.addEventListener('mouseover', function() {
                document.querySelector('.create-lead-image').classList.add('hovered');
                document.querySelector('.create-lead-title').classList.add('hovered');
            });
            button.addEventListener('mouseout', function() {
                document.querySelector('.create-lead-image').classList.remove('hovered');
                document.querySelector('.create-lead-title').classList.remove('hovered');
            });
        });
    </script>

    @include('customPages.createLeadPage.create-lead-page-styles')
</div>