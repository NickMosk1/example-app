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
            <label for="quantity">Количество:</label>
            <input type="number" id="quantity" wire:model="quantity" min="1" required>
            @error('quantity') <span class="error-message">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="type">Тип заявки:</label>
            <input type="text" id="type" wire:model="type" required>
            @error('type') <span class="error-message">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="status">Статус:</label>
            <select id="status" wire:model="status" required>
                <option value="">Выберите статус</option>
                <option value="pending">В ожидании</option>
                <option value="in_progress">В работе</option>
                <option value="sold_to_partner">Продана партнеру</option>
                <option value="cancelled">Отменена</option>
            </select>
            @error('status') <span class="error-message">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="source_id">Источник:</label>
            <select id="source_id" wire:model.live="source_id" required>
                <option value="">Выберите источник</option>
                @foreach($sources as $source)
                    <option value="{{ $source->id }}">{{ $source->name }}</option>
                @endforeach
                <option value="new">Зарегистрировать новый</option>
            </select>
            @error('source_id') <span class="error-message">{{ $message }}</span> @enderror
        </div>

        <!-- Поля для цен -->
        <div>
            <label for="purchase_price">Цена покупки:</label>
            <input type="number" id="purchase_price" wire:model="purchase_price" min="0" step="0.01" required>
            @if(isset($priceRanges['min_purchase']))
                <small class="price-range-hint">
                    Допустимый диапазон покупки: {{ $priceRanges['min_purchase'] }} - {{ $priceRanges['max_purchase'] }}
                </small>
            @endif
            @error('purchase_price') <span class="error-message">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="sale_price">Цена продажи:</label>
            <input type="number" id="sale_price" wire:model="sale_price" min="0" step="0.01" required>
            @if(isset($priceRanges['min_sale']))
                <small class="price-range-hint">
                    Допустимый диапазон продажи: {{ $priceRanges['min_sale'] }} - {{ $priceRanges['max_sale'] }}
                </small>
            @endif
            @error('sale_price') <span class="error-message">{{ $message }}</span> @enderror
        </div>

        @if($showSourceForm)
            <div class="source-form">
                <h3>Регистрация нового источника</h3>
                
                <div>
                    <label for="newSourceName">Название источника:</label>
                    <input type="text" id="newSourceName" wire:model="newSourceName" required>
                    @error('newSourceName') <span class="error-message">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label for="newSourceEmail">Email:</label>
                    <input type="email" id="newSourceEmail" wire:model="newSourceEmail" required>
                    @error('newSourceEmail') <span class="error-message">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label for="newSourcePhone">Телефон:</label>
                    <input type="text" id="newSourcePhone" wire:model="newSourcePhone" required>
                    @error('newSourcePhone') <span class="error-message">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label for="newSourceMinPurchase">Мин. цена покупки:</label>
                    <input type="number" id="newSourceMinPurchase" wire:model="newSourceMinPurchase" min="0" step="0.01" required>
                    @error('newSourceMinPurchase') <span class="error-message">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label for="newSourceMaxPurchase">Макс. цена покупки:</label>
                    <input type="number" id="newSourceMaxPurchase" wire:model="newSourceMaxPurchase" min="0" step="0.01" required>
                    @error('newSourceMaxPurchase') <span class="error-message">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label for="newSourceMinSale">Мин. цена продажи:</label>
                    <input type="number" id="newSourceMinSale" wire:model="newSourceMinSale" min="0" step="0.01" required>
                    @error('newSourceMinSale') <span class="error-message">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label for="newSourceMaxSale">Макс. цена продажи:</label>
                    <input type="number" id="newSourceMaxSale" wire:model="newSourceMaxSale" min="0" step="0.01" required>
                    @error('newSourceMaxSale') <span class="error-message">{{ $message }}</span> @enderror
                </div>
            </div>
        @endif

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

        Livewire.on('priceUpdated', (data) => {
            if (data.sale_price) {
                document.getElementById('sale_price').value = data.sale_price;
            }
        });
    </script>

    @include('customPages.createLeadPage.create-lead-page-styles')
</div>