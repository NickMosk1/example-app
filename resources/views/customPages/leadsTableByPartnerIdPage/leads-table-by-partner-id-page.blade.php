<div>
    <div class="table-actions">
        <h2 class="leads-amount">Всего заявок: {{ $leads->total() }}</h2>
        
        <div class="import-export-buttons">
            <button wire:click="export" class="admin-button">
                <span>Экспорт в Excel</span>
            </button>
        </div>
    </div>

    <div class="table-container">
        <table class="lead-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Количество</th>
                    <th>Описание</th>
                    <th>Партнер</th>
                    <th>Источник</th>
                    <th>Цена покупки</th>
                    <th>Цена продажи</th>
                    <th>Статус</th>
                    <th>Создана</th>
                    <th>Обновлена</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leads as $lead)
                    <tr>
                        <td>{{ $lead->id }}</td>
                        <td>{{ $lead->quantity }}</td>
                        <td>{{ $lead->type }}</td>
                        <td>
                            @if($lead->partner)
                                <span class="partner-name">{{ $lead->partner->name }}</span>
                            @else
                                <span class="no-partner">Не указан</span>
                            @endif
                        </td>
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
                                {{ $this->getStatusText($lead->status) }}
                            </span>
                        </td>
                        <td>{{ $lead->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $lead->updated_at->format('d.m.Y H:i') }}</td>
                        <td class="actions-cell">
                            <div class="record-button-container">
                                <button class="btn-reject" wire:click="rejectLead({{ $lead->id }})" title="Отказаться от заявки">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $leads->links() }}

    @include('customPages.leadsTableByPartnerIdPage.leads-table-by-partner-id-page-styles')
</div>