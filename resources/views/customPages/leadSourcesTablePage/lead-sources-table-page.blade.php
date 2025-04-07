<div>
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
        <tbody>
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
                        @if(!$source->is_native)
                            {{ number_format($source->min_purchase_price, 2) }} - {{ number_format($source->max_purchase_price, 2) }} ₽
                        @else
                            <span class="no-price">—</span>
                        @endif
                    </td>
                    <td>
                        @if(!$source->is_native)
                            {{ number_format($source->min_sale_price, 2) }} - {{ number_format($source->max_sale_price, 2) }} ₽
                        @else
                            <span class="no-price">—</span>
                        @endif
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
                        <button class="btn-stats" wire:click="showSourceStats({{ $source->id }})">
                            <i class="fas fa-chart-pie"></i> Статистика
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($showStatsModal)
        <div class="stats-modal-overlay">
            <div class="stats-modal-content">
                <div class="stats-modal-header">
                    <h3>Аналитика по источнику: {{ $currentSource->name }}</h3>
                    <button class="close-modal" wire:click="closeStatsModal">&times;</button>
                </div>
                
                <div class="stats-grid">
                    <!-- Общая статистика -->
                    <div class="stats-card total-stats">
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
                    </div>
                    
                    <!-- Финансовая статистика -->
                    <div class="stats-card financial-stats">
                        <h4>Финансовые показатели</h4>
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
                    
                    <!-- Графики -->
                    <div class="stats-card chart-container">
                        <h4>Статусы заявок</h4>
                        <canvas id="statusChart" width="400" height="200"></canvas>
                    </div>
                    
                    <div class="stats-card chart-container">
                        <h4>Динамика заявок</h4>
                        <canvas id="timelineChart" width="400" height="200"></canvas>
                    </div>
                    
                    <!-- Топ заявок -->
                    <div class="stats-card top-leads">
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
                </div>
            </div>
        </div>
    @endif

    @include('customPages.leadSourcesTablePage.lead-sources-table-page-styles')
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('showStats', function(data) {
            // Инициализация графиков
            initCharts(data.chartData);
        });

        function initCharts(data) {
            // Круговой график статусов
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            new Chart(statusCtx, {
                type: 'pie',
                data: {
                    labels: data.statusLabels,
                    datasets: [{
                        data: data.statusValues,
                        backgroundColor: [
                            '{{$colors['ORANGE']}}',
                            '{{$colors['BLUE']}}',
                            '{{$colors['GREEN']}}',
                            '{{$colors['RED']}}'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    }
                }
            });

            // Линейный график динамики
            const timelineCtx = document.getElementById('timelineChart').getContext('2d');
            new Chart(timelineCtx, {
                type: 'line',
                data: {
                    labels: data.timelineLabels,
                    datasets: [{
                        label: 'Заявки по дням',
                        data: data.timelineValues,
                        backgroundColor: '#000fff',
                        borderColor: '#0000ff',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    });
</script>
@endpush