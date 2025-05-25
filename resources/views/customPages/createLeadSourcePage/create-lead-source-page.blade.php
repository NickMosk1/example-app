<div class="create-lead-container">
    <div class="create-lead-image-container">
        <img class="create-lead-image" src="{{ asset('additional/createLead.JPG') }}" alt="Панель создания источника">
    </div>
    
    <div class="create-lead-title">Панель создания источника</div>

    @if (session()->has('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent="create">
        <div>
            <label for="name">Название источника:</label>
            <input type="text" id="name" wire:model="name" required>
            @error('name') <span class="error-message">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" wire:model="email" required>
            @error('email') <span class="error-message">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="phone">Телефон:</label>
            <input type="text" id="phone" wire:model="phone" required>
            @error('phone') <span class="error-message">{{ $message }}</span> @enderror
        </div>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="minPurchase">Мин. цена покупки:</label>
                <input type="number" id="minPurchase" wire:model="minPurchase" min="0" step="0.01" required>
                @error('minPurchase') <span class="error-message">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label for="maxPurchase">Макс. цена покупки:</label>
                <input type="number" id="maxPurchase" wire:model="maxPurchase" min="0" step="0.01" required>
                @error('maxPurchase') <span class="error-message">{{ $message }}</span> @enderror
            </div>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="minSale">Мин. цена продажи:</label>
                <input type="number" id="minSale" wire:model="minSale" min="0" step="0.01" required>
                @error('minSale') <span class="error-message">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label for="maxSale">Макс. цена продажи:</label>
                <input type="number" id="maxSale" wire:model="maxSale" min="0" step="0.01" required>
                @error('maxSale') <span class="error-message">{{ $message }}</span> @enderror
            </div>
        </div>

        <button class="create-lead-button" type="submit">Создать источник</button>
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

    @include('customPages.createLeadSourcePage.create-lead-source-page-styles')
</div>