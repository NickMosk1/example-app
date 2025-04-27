<div>
    <div class="partners-amount">Количество партнеров: {{ $partners->total() }}</div>

    <table class="partner-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Количество заявок</th>
                <th>Дата регистрации</th>
                <th>Обновлен</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody wire:poll.1000ms>
            @foreach($partners as $partner)
                <tr>
                    <td>{{ $partner->id }}</td>
                    <td>{{ $partner->name }}</td>
                    <td>{{ $partner->email }}</td>
                    <td>{{ $partner->phone }}</td>
                    <td>{{ $partner->leads_count }}</td>
                    <td>{{ $partner->created_at->format('d.m.Y H:i') }}</td>
                    <td>{{ $partner->updated_at->format('d.m.Y H:i') }}</td>
                    <td class="actions-cell">
                        <div class="record-button-container">
                            <button class="btn-stats" wire:click="showPartnerStats({{ $partner->id }})">
                                <i class="fas fa-chart-pie"></i> Статистика
                            </button>
                            <button class="btn-edit" wire:click="edit({{ $partner->id }})">
                                <img class="edit-image" src="{{ asset('additional/edit3.JPG') }}" alt="Редактирование">
                            </button>
                            <button class="btn-delete" wire:click="confirmDelete({{ $partner->id }})">
                                <img class="delete-image" src="{{ asset('additional/delete2.JPG') }}" alt="Удаление">
                            </button> 
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $partners->links() }}

    @if($showStatsModal)
        <div class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Аналитика по партнеру: {{ $currentPartner->name }}</h3>
                    <button class="close-modal" wire:click="closeStatsModal">&times;</button>
                </div>
                
                <div class="stats-grid">
                    <!-- Общая статистика -->
                    <div class="stats-card">
                        <h4>Общая статистика</h4>
                        <div class="stats-row">
                            <span>Всего заявок:</span>
                            <span class="value">{{ $stats['total_leads'] ?? 0 }}</span>
                        </div>
                        <div class="stats-row">
                            <span>Завершенных сделок:</span>
                            <span class="value">{{ $stats['completed_deals'] ?? 0 }}</span>
                        </div>
                        <div class="stats-row">
                            <span>В работе:</span>
                            <span class="value">{{ $stats['in_progress'] ?? 0 }}</span>
                        </div>
                        <div class="stats-row">
                            <span>Отменено:</span>
                            <span class="value">{{ $stats['cancelled'] ?? 0 }}</span>
                        </div>
                        <div class="stats-row">
                            <span>Конверсия:</span>
                            <span class="value">{{ $stats['conversion_rate'] ?? 0 }}%</span>
                        </div>
                    </div>
                    
                    <!-- Финансовая статистика -->
                    <div class="stats-card">
                        <h4>Финансовые показатели</h4>
                        <div class="stats-row">
                            <span>Средняя сумма сделки:</span>
                            <span class="value">{{ number_format($stats['avg_deal_amount'] ?? 0, 2) }} ₽</span>
                        </div>
                        <div class="stats-row">
                            <span>Общий оборот:</span>
                            <span class="value">{{ number_format($stats['total_turnover'] ?? 0, 2) }} ₽</span>
                        </div>
                        <div class="stats-row">
                            <span>Средняя прибыль:</span>
                            <span class="value">{{ number_format($stats['avg_profit'] ?? 0, 2) }} ₽</span>
                        </div>
                        <div class="stats-row profit">
                            <span>Общая прибыль:</span>
                            <span class="value {{ ($stats['total_profit'] ?? 0) >= 0 ? 'positive' : 'negative' }}">
                                {{ number_format($stats['total_profit'] ?? 0, 2) }} ₽
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
                        <h4>Динамика сделок</h4>
                        <div x-data="chartComponent('finance')" x-init="initChart()" class="chart-container">
                            <div x-ref="chart"></div>
                            <template x-if="loading">
                                <div class="chart-loading">Загрузка данных...</div>
                            </template>
                        </div>
                    </div>
                    
                    <!-- Топ сделок -->
                    <div class="stats-card">
                        <h4>Самые крупные сделки</h4>
                        <div class="leads-list">
                            @foreach(($stats['top_deals'] ?? []) as $deal)
                                <div class="lead-item">
                                    <div class="lead-id">#{{ $deal->id }}</div>
                                    <div class="lead-profit">
                                        Сумма: {{ number_format($deal->sale_price ?? 0, 2) }} ₽
                                    </div>
                                    <div class="lead-dates">
                                        {{ $deal->created_at->format('d.m.Y') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Последние сделки -->
                    <div class="stats-card">
                        <h4>Последние сделки</h4>
                        <div class="leads-list scrollable">
                            @foreach(($stats['recent_deals'] ?? []) as $deal)
                                <div class="lead-item">
                                    <div class="lead-id">#{{ $deal->id }}</div>
                                    <div class="lead-status {{ str_replace('_', '-', $deal->status) }}">
                                        {{ $this->getStatusLabel($deal->status) }}
                                    </div>
                                    <div class="lead-dates">
                                        {{ $deal->created_at->format('d.m.Y H:i') }}
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
                <div class="modal-image-container">
                    <img class="modal-image" src="{{ asset('additional/account.JPG') }}" alt="Редактирование партнера">
                </div>
                
                <div class="modal-title">Редактирование партнера #{{ $editingPartnerId }}</div>

                @if (session()->has('modal_success'))
                    <div class="success">{{ session('modal_success') }}</div>
                @endif
                @if (session()->has('modal_error'))
                    <div class="error">{{ session('modal_error') }}</div>
                @endif

                <form wire:submit.prevent="update">
                    <div>
                        <label for="modal_name">Название:</label>
                        <input type="text" id="modal_name" wire:model="name" required>
                        @error('name') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="modal_email">Email:</label>
                        <input type="email" id="modal_email" wire:model="email" required>
                        @error('email') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="modal_phone">Телефон:</label>
                        <input type="tel" id="modal_phone" wire:model="phone">
                        @error('phone') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="modal-actions">
                        <button class="modal-save-button" type="submit">Сохранить</button>
                        <button class="modal-cancel-button" type="button" wire:click="closeModal">Отмена</button>
                    </div>
                </form>

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
            </div>
        </div>
    @endif

    @push('scripts')
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
                
                Livewire.on('updatePartnerCharts', (data) => {
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
                        colors: [colors.BLUE],
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

    @include('customPages.partnersTablePage.partners-table-page-styles')
</div>