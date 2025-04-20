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

    {{ $sources->links() }}

    @if($showStatsModal)
        <div class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Аналитика по источнику: {{ $currentSource->name }}</h3>
                    <button class="close-modal" wire:click="closeStatsModal">&times;</button>
                </div>
                
                <div class="stats-grid">
                    <!-- Общая статистика -->
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
                    
                    <!-- Финансовая статистика -->
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
                    
                    <!-- График статусов -->
                    <div class="stats-card">
                        <h4>Статусы заявок</h4>
                        <div x-data="chartComponent('status')" x-init="initChart()" class="chart-container">
                            <div x-ref="chart"></div>
                            <template x-if="loading">
                                <div class="chart-loading">Загрузка данных...</div>
                            </template>
                        </div>
                    </div>

                    <!-- График финансовых показателей -->
                    <div class="stats-card">
                        <h4>Финансовые показатели</h4>
                        <div x-data="chartComponent('finance')" x-init="initChart()" class="chart-container">
                            <div x-ref="chart"></div>
                            <template x-if="loading">
                                <div class="chart-loading">Загрузка данных...</div>
                            </template>
                        </div>
                    </div>
                    
                    <!-- Топ заявок -->
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
                    
                    <!-- Последние заявки -->
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

    @include('customPages.leadSourcesTablePage.lead-sources-table-page-styles')

     @push('scripts')
    <!-- Убедитесь, что Alpine загружается только один раз -->
    @if(!app()->environment('testing'))
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('chartComponent', (type) => ({
            chart: null,
            loading: true,
            chartType: type,
            
            initChart() {
                this.initEmptyChart();
                
                // Следим за изменениями данных от Livewire
                this.$watch('data', (newData) => {
                    if (newData) {
                        this.updateChart(newData);
                    }
                });

                // Альтернативный вариант для Livewire
                Livewire.on('updateCharts', (data) => {
                    this.updateChart(data);
                });
            },
            
            initEmptyChart() {
                const emptyConfig = this.getChartConfig({
                    chartData: {
                        statusLabels: ['Нет данных'],
                        statusValues: [1],
                        financeLabels: ['Нет данных'],
                        financeValues: [0]
                    }
                });
                
                this.chart = new ApexCharts(this.$refs.chart, emptyConfig);
                this.chart.render();
                this.loading = false;
            },
            
            updateChart(data) {
                try {
                    this.loading = true;
                    const config = this.getChartConfig(data);
                    
                    if (this.chart) {
                        this.chart.updateOptions(config);
                    } else {
                        this.chart = new ApexCharts(this.$refs.chart, config);
                        this.chart.render();
                    }
                } catch (e) {
                    console.error(`Ошибка обновления графика ${this.chartType}:`, e);
                    this.showError();
                } finally {
                    this.loading = false;
                }
            },
            
            getChartConfig(data) {
                const colors = {
                    ORANGE: '#FF9800',
                    BLUE: '#2196F3',
                    GREEN: '#4CAF50',
                    RED: '#F44336'
                };
                
                const commonOptions = {
                    chart: {
                        height: 300,
                        animations: {
                            enabled: true,
                            easing: 'easeinout'
                        }
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                height: 250
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };
                
                if (this.chartType === 'status') {
                    return {
                        ...commonOptions,
                        chart: { type: 'donut' },
                        series: data.chartData.statusValues || [0],
                        labels: data.chartData.statusLabels || ['Нет данных'],
                        colors: [colors.ORANGE, colors.BLUE, colors.GREEN, colors.RED],
                        plotOptions: {
                            pie: {
                                donut: {
                                    labels: {
                                        show: true,
                                        total: {
                                            show: true,
                                            label: 'Всего',
                                            color: '#333'
                                        }
                                    }
                                }
                            }
                        }
                    };
                } else { // finance
                    return {
                        ...commonOptions,
                        chart: { type: 'bar' },
                        series: [{
                            name: 'Сумма (₽)',
                            data: data.chartData.financeValues || [0]
                        }],
                        colors: [colors.GREEN],
                        xaxis: {
                            categories: data.chartData.financeLabels || ['Нет данных']
                        },
                        yaxis: {
                            labels: {
                                formatter: function(val) {
                                    return val.toLocaleString('ru-RU') + ' ₽';
                                }
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function(val) {
                                    return val.toLocaleString('ru-RU') + ' ₽';
                                }
                            }
                        }
                    };
                }
            },
            
            showError() {
                this.$refs.chart.innerHTML = '<div class="chart-error">Ошибка загрузки графика</div>';
            }
        }));
    });
    </script>
    @endpush
</div>