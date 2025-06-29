<div>
    <div class="table-actions">
        <div class="import-export-buttons">
            <button wire:click="$set('showImportModal', true)" class="admin-button">
                <span>Импорт из Excel</span>
            </button>
            
            <button wire:click="export" class="admin-button">
                <span>Экспорт в Excel</span>
            </button>
        </div>
    </div>

    @if($showImportModal)
    <div class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-image-container">
                    <img class="modal-image admin-modal-image" src="{{ asset('additional/adminPanel.JPG') }}" alt="Импорт">
                </div>
                <h3 class="modal-title">Импорт заявок</h3>
            </div>
            
            <form wire:submit.prevent="import">
                <div class="file-upload-wrapper">
                    <label class="file-upload-label">
                        <input 
                            type="file" 
                            wire:model="importFile" 
                            accept=".xlsx,.xls,.csv"
                            class="file-upload-input"
                        >
                        <span class="file-upload-text">Выберите файл Excel</span>
                        <span class="file-upload-button">Обзор</span>
                    </label>
                    @error('importFile') 
                        <span class="error-message">{{ $message }}</span> 
                    @enderror
                </div>
                
                <div class="modal-actions">
                    <button 
                        type="submit" 
                        class="modal-save-button"
                        wire:loading.attr="disabled"
                        wire:target="importFile"
                    >
                        <span wire:loading wire:target="importFile" class="loading-spinner">
                            <svg class="spinner-icon" viewBox="0 0 50 50">
                                <circle class="spinner-path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                            </svg>
                            Идет загрузка...
                        </span>
                        <span wire:loading.remove wire:target="importFile">Импортировать</span>
                    </button>
                    <button 
                        type="button" 
                        class="modal-cancel-button" 
                        wire:click="$set('showImportModal', false)"
                    >
                        Отмена
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <div class="table-container">
        <table class="lead-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Количество</th>
                    <th>Описание</th>
                    <th>Источник</th>
                    <th>Передана партнеру</th>
                    <th>Цена покупки</th>
                    <th>Цена продажи</th>
                    <th>Статус</th>
                    <th>Создана</th>
                    <th>Обновлена</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody wire:poll.1000ms>
                @foreach($leads as $lead)
                    <tr>
                        <td>{{ $lead->id }}</td>
                        <td>{{ $lead->quantity }}</td>
                        <td>{{ $lead->type }}</td>
                        <td>
                            @if($lead->leadSource)
                                <div class="source-cell">
                                    <span class="source-name">{{ $lead->leadSource->name }}</span>
                                    @if($lead->leadSource->is_native)
                                        <span class="native-badge" title="Внутренний источник"></span>
                                    @endif
                                </div>
                            @else
                                <span class="no-source">Не указан</span>
                            @endif
                        </td>
                        <td>
                            @if($lead->partner)
                                <span class="partner-name">{{ $lead->partner->name }}</span>
                            @else
                                <span class="no-partner">Не указан</span>
                            @endif
                        </td>
                        <td class="price-cell">
                            @if($lead->purchase_price)
                                {{ number_format($lead->purchase_price, 2) }} ₽
                            @else
                                <span class="no-price">—</span>
                            @endif
                        </td>
                        <td class="price-cell">
                            @if($lead->sale_price)
                                {{ number_format($lead->sale_price, 2) }} ₽
                            @else
                                <span class="no-price">—</span>
                            @endif
                        </td>
                        <td class="status-cell">
                            <span class="status-badge status-{{ str_replace(' ', '_', strtolower($lead->status)) }}">
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
                                    @default
                                        Неизвестный статус
                                @endswitch
                            </span>
                        </td>
                        <td>{{ $lead->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $lead->updated_at->format('d.m.Y H:i') }}</td>
                        <td class="actions-cell">
                            <div class="record-button-container">
                                <button class="btn-edit" wire:click="edit({{ $lead->id }})">
                                    <img class="edit-image" src="{{ asset('additional/edit3.JPG') }}" alt="Редактирование">
                                </button>
                                <button class="btn-delete" wire:click="confirmDelete({{ $lead->id }})">
                                    <img class="delete-image" src="{{ asset('additional/delete2.JPG') }}" alt="Удаление">
                                </button> 
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $leads->links() }}

    @if($showEditModal)
        <div class="modal-overlay">
            <div class="modal-content">
                <div class="modal-image-container">
                    <img class="modal-image" src="{{ asset('additional/createLead.JPG') }}" alt="Редактирование заявки">
                </div>
                
                <div class="modal-title">Редактирование заявки #{{ $editingLeadId }}</div>

                @if (session()->has('modal_success'))
                    <div class="success">{{ session('modal_success') }}</div>
                @endif
                @if (session()->has('modal_error'))
                    <div class="error">{{ session('modal_error') }}</div>
                @endif

                <form wire:submit.prevent="update">
                    <div>
                        <label for="modal_quantity">Количество:</label>
                        <input type="number" id="modal_quantity" wire:model="quantity" required min="1">
                        @error('quantity') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="modal_type">Тип:</label>
                        <textarea id="modal_type" wire:model="type" required></textarea>
                        @error('type') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="modal_status">Статус:</label>
                        <select id="modal_status" wire:model="status" required>
                            <option value="pending">В ожидании</option>
                            <option value="in_progress">В работе</option>
                            <option value="sold_to_partner">Продана партнеру</option>
                            <option value="cancelled">Отменена</option>
                        </select>
                        @error('status') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="modal_purchase_price">Цена покупки (₽):</label>
                        <input type="number" id="modal_purchase_price" wire:model="purchase_price" step="0.01" min="0">
                        @error('purchase_price') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="modal_sale_price">Цена продажи (₽):</label>
                        <input type="number" id="modal_sale_price" wire:model="sale_price" step="0.01" min="0">
                        @error('sale_price') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="modal_lead_source_id">Источник:</label>
                        <select id="modal_lead_source_id" wire:model="leadSourceId">
                            <option value="">-- Не выбран --</option>
                            @foreach($leadSources as $source)
                                <option value="{{ $source->id }}">{{ $source->name }}</option>
                            @endforeach
                        </select>
                        @error('leadSourceId') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="modal_partner_id">Партнер:</label>
                        <select id="modal_partner_id" wire:model="partnerId">
                            <option value="">-- Не выбран --</option>
                            @foreach($partners as $partner)
                                <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                            @endforeach
                        </select>
                        @error('partnerId') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="modal-actions">
                        <button class="modal-save-button" type="submit">Сохранить</button>
                        <button class="modal-cancel-button" type="button" wire:click="closeModal">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('livewire:load', function() {
            const saveButton = document.querySelector('.modal-save-button');
            if (saveButton) {
                saveButton.addEventListener('mouseover', function() {
                    const image = document.querySelector('.modal-image');
                    const title = document.querySelector('.modal-title');
                    if (image) image.classList.add('hovered');
                    if (title) title.classList.add('hovered');
                });
                
                saveButton.addEventListener('mouseout', function() {
                    const image = document.querySelector('.modal-image');
                    const title = document.querySelector('.modal-title');
                    if (image) image.classList.remove('hovered');
                    if (title) title.classList.remove('hovered');
                });
            }
        });
    </script>

    @include('customPages.leadsTablePage.leads-table-page-styles')
</div>