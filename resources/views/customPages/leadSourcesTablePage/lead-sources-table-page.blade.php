<div>
    <div class="sources-amount">
        Всего источников: <span>{{ $sources->total() }}</span>
    </div>

    <table class="sources-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Тип</th>
                <th>Заявок</th>
                <th>Цена покупки (мин-макс)</th>
                <th>Цена продажи (мин-макс)</th>
                <th>Контакты</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody wire:poll.1000ms>
            @foreach($sources as $source)
                <tr>
                    <td>{{ $source->id }}</td>
                    <td>{{ $source->name }}</td>
                    <td>
                        <span class="source-type-badge {{ $source->is_native ? 'native' : 'external' }}">
                            {{ $source->is_native ? 'Нативный' : 'Внешний' }}
                        </span>
                    </td>
                    <td>{{ $source->total_leads }}</td>
                    <td>
                        {{ number_format($source->min_purchase_price, 2) }} - {{ number_format($source->max_purchase_price, 2) }} ₽
                    </td>
                    <td>
                        {{ number_format($source->min_sale_price, 2) }} - {{ number_format($source->max_sale_price, 2) }} ₽
                    </td>
                    <td>
                        <div class="contacts-info">
                            @if($source->email)
                                <div class="contact-item">
                                    <i class="fas fa-envelope"></i> {{ $source->email }}
                                </div>
                            @endif
                            @if($source->phone)
                                <div class="contact-item">
                                    <i class="fas fa-phone"></i> {{ $source->phone }}
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="actions-cell">
                        <div class="record-button-container">
                            <button class="btn-edit" wire:click="edit({{ $source->id }})">
                                <i class="fas fa-pencil"></i>
                            </button>
                            <button class="btn-delete" wire:click="confirmDelete({{ $source->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button class="btn-stats" wire:click="showSourceStats({{ $source->id }})">
                                <i class="fas fa-chart-pie"></i> Статистика
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $sources->links() }}

    @if($showStatsModal)
        <div class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Аналитика по источнику: {{ $currentSource->name }}</h3>
                    <button class="close-modal" wire:click="closeStatsModal">&times;</button>
                </div>
                
                <div class="stats-grid">

                    <div class="stats-card">
                        <h4>Общая статистика</h4>
                        <div class="stats-row">
                            <span>Всего заявок:</span>
                            <span class="value">{{ $stats['total_leads'] }}</span>
                        </div>
                        <div class="stats-row">
                            <span>Продано партнерам:</span>
                            <span class="value">{{ $stats['sold_leads'] }}</span>
                        </div>
                        <div class="stats-row">
                            <span>В работе:</span>
                            <span class="value">{{ $stats['in_progress'] }}</span>
                        </div>
                        <div class="stats-row">
                            <span>В ожидании:</span>
                            <span class="value">{{ $stats['pending'] }}</span>
                        </div>
                        <div class="stats-row">
                            <span>Отменено:</span>
                            <span class="value">{{ $stats['cancelled'] }}</span>
                        </div>
                        <div class="stats-row">
                            <span>Конверсия:</span>
                            <span class="value">{{ $stats['conversion_rate'] }}%</span>
                        </div>
                    </div>
                    
                    <div class="stats-card">
                        <h4>Финансовые показатели</h4>
                        <div class="stats-row">
                            <span>Средняя цена покупки:</span>
                            <span class="value">{{ number_format($stats['avg_purchase_price'], 2) }} ₽</span>
                        </div>
                        <div class="stats-row">
                            <span>Средняя цена продажи:</span>
                            <span class="value">{{ number_format($stats['avg_sale_price'], 2) }} ₽</span>
                        </div>
                        <div class="stats-row">
                            <span>Средняя прибыль:</span>
                            <span class="value">{{ number_format($stats['avg_profit'], 2) }} ₽</span>
                        </div>
                        <div class="stats-row">
                            <span>Общие затраты:</span>
                            <span class="value">{{ number_format($stats['total_purchase'], 2) }} ₽</span>
                        </div>
                        <div class="stats-row">
                            <span>Потенциальный доход:</span>
                            <span class="value">{{ number_format($stats['potential_income'], 2) }} ₽</span>
                        </div>
                        <div class="stats-row">
                            <span>Фактический доход:</span>
                            <span class="value">{{ number_format($stats['actual_income'], 2) }} ₽</span>
                        </div>
                        <div class="stats-row profit">
                            <span>Прибыль:</span>
                            <span class="value {{ $stats['profit'] >= 0 ? 'positive' : 'negative' }}">
                                {{ number_format($stats['profit'], 2) }} ₽
                            </span>
                        </div>
                    </div>

                    <div class="stats-card">
                        <h4>Самые выгодные заявки</h4>
                        <div class="leads-list">
                            @foreach($stats['top_profitable'] as $lead)
                                <div class="lead-item">
                                    <div class="lead-id">#{{ $lead->id }}</div>
                                    <div class="lead-profit">
                                        Прибыль: {{ number_format($lead->sale_price - $lead->purchase_price, 2) }} ₽
                                    </div>
                                    <div class="lead-dates">
                                        {{ $lead->created_at->format('d.m.Y') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="stats-card">
                        <h4>Последние заявки</h4>
                        <div class="leads-list scrollable">
                            @foreach($stats['leads_by_date'] as $lead)
                                <div class="lead-item">
                                    <div class="lead-id">#{{ $lead->id }}</div>
                                    <div class="lead-status {{ str_replace('_', '-', $lead->status) }}">
                                        {{ match($lead->status) {
                                            'pending' => 'В ожидании',
                                            'in_progress' => 'В работе',
                                            'sold_to_partner' => 'Продано партнеру',
                                            'cancelled' => 'Отменено',
                                            default => $lead->status
                                        } }}
                                    </div>
                                    <div class="lead-dates">
                                        {{ $lead->created_at->format('d.m.Y H:i') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($showEditModal)
        <div class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Редактирование источника #{{ $editingSourceId }}</h3>
                </div>

                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                <form wire:submit.prevent="update">
                    <div class="form-group">
                        <label for="name">Название</label>
                        <input type="text" id="name" wire:model="form.name" class="form-input">
                        @error('form.name') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="checkbox" wire:model="form.is_native">
                            Нативный источник
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" wire:model="form.email" class="form-input">
                        @error('form.email') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Телефон</label>
                        <input type="text" id="phone" wire:model="form.phone" class="form-input">
                        @error('form.phone') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="min_purchase_price">Минимальная цена покупки</label>
                        <input type="number" id="min_purchase_price" wire:model="form.min_purchase_price" class="form-input" min="0" step="0.01">
                        @error('form.min_purchase_price') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="max_purchase_price">Максимальная цена покупки</label>
                        <input type="number" id="max_purchase_price" wire:model="form.max_purchase_price" class="form-input" min="0" step="0.01">
                        @error('form.max_purchase_price') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="min_sale_price">Минимальная цена продажи</label>
                        <input type="number" id="min_sale_price" wire:model="form.min_sale_price" class="form-input" min="0" step="0.01">
                        @error('form.min_sale_price') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="max_sale_price">Максимальная цена продажи</label>
                        <input type="number" id="max_sale_price" wire:model="form.max_sale_price" class="form-input" min="0" step="0.01">
                        @error('form.max_sale_price') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="modal-actions">
                        <button type="submit" class="btn-save">Сохранить</button>
                        <button type="button" class="btn-cancel" wire:click="closeEditModal">Отмена</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @include('customPages.leadSourcesTablePage.lead-sources-table-page-styles')
</div>