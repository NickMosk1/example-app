<div>
    <div class="flash-messages-container">
        @if(session()->has('success'))
            <div class="flash-message flash-success">
                <span>{{ session('success') }}</span>
                <button class="flash-close-btn">&times;</button>
            </div>
        @endif

        @if(session()->has('warning'))
            <div class="flash-message flash-warning">
                <span>{{ session('warning') }}</span>
                <button class="flash-close-btn">&times;</button>
            </div>
        @endif
    </div>
    <div class="table-actions">
        <div class="import-export-buttons">
            <button wire:click="$set('showImportModal', true)" class="admin-button">
                <span>Импорт из Excel</span>
            </button>

            <button wire:click="export" class="admin-button">
                <span>Экспорт в Excel</span>
            </button>
        </div>
        
        <div class="filters-container">
            <div class="filter-group">
                <label class="filter-label sourceFilter">Источник:</label>
                <select id="sourceFilter" wire:model="sourceFilter" class="filter-select">
                    <option value="">Все источники</option>
                    @foreach($leadSources as $source)
                        <option value="{{ $source->id }}">{{ $source->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label class="filter-label partnerFilter">Партнер:</label>
                <select id="partnerFilter" wire:model="partnerFilter" class="filter-select">
                    <option value="">Все партнеры</option>
                    @foreach($partners as $partner)
                        <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label class="filter-label statusFilter">Статус:</label>
                <select id="statusFilter" wire:model="statusFilter" class="filter-select">
                    <option value="">Все статусы</option>
                    <option value="pending">В ожидании</option>
                    <option value="in_progress">В работе</option>
                    <option value="sold_to_partner">Продана партнеру</option>
                    <option value="cancelled">Отменена</option>
                </select>
            </div>
            <div class="filter-group">
                <label class="filter-label sortField">Сортировать по:</label>
                <select id="sortField" wire:model="sortField" class="filter-select">
                    <option value="created_at">Дате создания</option>
                    <option value="updated_at">Дате обновления</option>
                    <option value="quantity">Количеству</option>
                    <option value="purchase_price">Цене покупки</option>
                    <option value="sale_price">Цене продажи</option>
                </select>
            </div>
            <div class="filter-group">
                <label class="filter-label sortDirection">Направление:</label>
                <select id="sortDirection" wire:model="sortDirection" class="filter-select">
                    <option value="asc">По возрастанию</option>
                    <option value="desc">По убыванию</option>
                </select>
            </div>
            <div class="filter-group filter-reset">
                <button wire:click="resetFilters" class="admin-button reset-button">
                    Сбросить фильтры
                </button>
            </div>
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
                            <span class="file-upload-text">
                                @if($importFile)
                                    <i class="fas fa-file-excel" style="color: green; margin-right: 5px;"></i>
                                    {{ $importFile->getClientOriginalName() }}
                                @endif
                            </span>
                        </label>
                        @error('importFile') 
                            <span class="error-message">{{ $message }}</span> 
                        @enderror
                        
                        <div wire:loading wire:target="importFile" class="upload-progress">
                            <div class="progress-bar">
                                <div class="progress"></div>
                            </div>
                            <div class="progress-text">Загрузка файла...</div>
                        </div>
                    </div>
                    
                    <div class="modal-actions">
                        <button type="submit" class="modal-save-button"
                            wire:loading.attr="disabled"
                            wire:target="import">
                        <span wire:loading.class="d-none" wire:target="import">
                            Импортировать
                        </span>
                        <span wire:loading wire:target="import">
                            <i class="fas fa-spinner fa-spin"></i> Идет импорт...
                        </span>
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
                    <th wire:click="sortBy('id')">
                        ID
                        @if($sortField === 'id')
                            @if($sortDirection === 'asc')
                                ↑
                            @else
                                ↓
                            @endif
                        @endif
                    </th>
                    <th wire:click="sortBy('quantity')">
                        Количество
                        @if($sortField === 'quantity')
                            @if($sortDirection === 'asc')
                                ↑
                            @else
                                ↓
                            @endif
                        @endif
                    </th>
                    <th>Описание</th>
                    <th>Источник</th>
                    <th>Передана партнеру</th>
                    <th wire:click="sortBy('purchase_price')">
                        Цена покупки
                        @if($sortField === 'purchase_price')
                            @if($sortDirection === 'asc')
                                ↑
                            @else
                                ↓
                            @endif
                        @endif
                    </th>
                    <th wire:click="sortBy('sale_price')">
                        Цена продажи
                        @if($sortField === 'sale_price')
                            @if($sortDirection === 'asc')
                                ↑
                            @else
                                ↓
                            @endif
                        @endif
                    </th>
                    <th>Статус</th>
                    <th wire:click="sortBy('created_at')">
                        Создана
                        @if($sortField === 'created_at')
                            @if($sortDirection === 'asc')
                                ↑
                            @else
                                ↓
                            @endif
                        @endif
                    </th>
                    <th wire:click="sortBy('updated_at')">
                        Обновлена
                        @if($sortField === 'updated_at')
                            @if($sortDirection === 'asc')
                                ↑
                            @else
                                ↓
                            @endif
                        @endif
                    </th>
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
                                    <i class="fas fa-pencil"></i>
                                </button>
                                <button class="btn-delete" wire:click="confirmDelete({{ $lead->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        <div class="pagination-info">
            Показано с {{ $leads->firstItem() }} по {{ $leads->lastItem() }} из {{ $leads->total() }} записей
        </div>
        
        <div class="pagination">
            @if($leads->onFirstPage())
                <span class="disabled">&laquo;</span>
            @else
                <button wire:click="previousPage" class="page-link">&laquo;</button>
            @endif
            
            @foreach($leads->getUrlRange(1, $leads->lastPage()) as $page => $url)
                @if($page == $leads->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <button wire:click="gotoPage({{ $page }})" class="page-link">{{ $page }}</button>
                @endif
            @endforeach
            
            @if($leads->hasMorePages())
                <button wire:click="nextPage" class="page-link">&raquo;</button>
            @else
                <span class="disabled">&raquo;</span>
            @endif
        </div>
        
        <div class="per-page-selector">
            <label for="perPage" class="per-page-label">Записей на странице:</label>
            <select id="perPage" wire:model="perPage" class="per-page-select">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
    </div>

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

        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.flash-message');
            flashMessages.forEach(message => {
                const timer = setTimeout(() => {
                    message.classList.add('fade-out');
                    setTimeout(() => {
                        message.remove();
                    }, 500);
                }, 5000);
                const closeBtn = message.querySelector('.flash-close-btn');
                if (closeBtn) {
                    closeBtn.addEventListener('click', function() {
                        clearTimeout(timer);
                        message.classList.add('fade-out');
                        setTimeout(() => message.remove(), 500);
                    });
                }
            });
        });
    </script>

    @include('customPages.leadsTablePage.leads-table-page-styles')
</div>