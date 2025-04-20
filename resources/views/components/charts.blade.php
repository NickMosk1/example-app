<!-- resources/views/components/charts.blade.php -->
<div x-data="chartComponent()" x-init="init()">
    <!-- График статусов -->
    <div class="stats-card">
        <h4>Статусы заявок</h4>
        <div x-ref="statusChart" class="chart-container"></div>
        <template x-if="loading">
            <div class="chart-loading">Загрузка данных...</div>
        </template>
    </div>

    <!-- График финансов -->
    <div class="stats-card">
        <h4>Финансовые показатели</h4>
        <div x-ref="financeChart" class="chart-container"></div>
        <template x-if="loading">
            <div class="chart-loading">Загрузка данных...</div>
        </template>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('chartComponent', () => ({
        statusChart: null,
        financeChart: null,
        loading: true,
        data: null,

        init() {
            // Инициализация пустых графиков
            this.initEmptyCharts();
            
            // Ожидаем данные от Livewire
            this.$watch('data', (newData) => {
                if (newData) {
                    this.updateCharts(newData);
                }
            });

            // Альтернативный вариант для Livewire
            Livewire.on('updateCharts', (data) => {
                this.data = data;
                this.updateCharts(data);
            });
        },

        initEmptyCharts() {
            const emptyConfig = {
                chart: { type: 'donut', height: 350 },
                series: [0],
                labels: ['Нет данных'],
                colors: ['#e0e0e0']
            };
            
            this.statusChart = new ApexCharts(this.$refs.statusChart, emptyConfig);
            this.statusChart.render();
            
            const emptyBarConfig = {
                chart: { type: 'bar', height: 350 },
                series: [{ data: [0] }],
                xaxis: { categories: ['Нет данных'] },
                colors: ['#e0e0e0']
            };
            
            this.financeChart = new ApexCharts(this.$refs.financeChart, emptyBarConfig);
            this.financeChart.render();
        },

        updateCharts(data) {
            if (!data?.chartData) {
                this.showError();
                return;
            }

            this.loading = true;
            
            try {
                this.updateStatusChart(data);
                this.updateFinanceChart(data);
            } catch (e) {
                console.error('Ошибка обновления графиков:', e);
                this.showError();
            } finally {
                this.loading = false;
            }
        },

        updateStatusChart(data) {
            const config = {
                series: data.chartData.statusValues || [0],
                labels: data.chartData.statusLabels || ['Нет данных'],
                colors: ['#FF9800', '#2196F3', '#4CAF50', '#F44336']
            };

            if (this.statusChart) {
                this.statusChart.updateSeries(config.series);
                this.statusChart.updateOptions(config);
            }
        },

        updateFinanceChart(data) {
            const config = {
                series: [{
                    name: 'Сумма (₽)',
                    data: data.chartData.financeValues || [0]
                }],
                xaxis: {
                    categories: data.chartData.financeLabels || ['Нет данных']
                },
                colors: ['#4CAF50']
            };

            if (this.financeChart) {
                this.financeChart.updateSeries(config.series);
                this.financeChart.updateOptions(config);
            }
        },

        showError() {
            const errorHtml = '<div class="chart-error">Ошибка загрузки данных</div>';
            if (this.$refs.statusChart) this.$refs.statusChart.innerHTML = errorHtml;
            if (this.$refs.financeChart) this.$refs.financeChart.innerHTML = errorHtml;
        }
    }));
});
</script>

<style>
.chart-container {
    width: 100%;
    min-height: 350px;
    position: relative;
}

.chart-loading, .chart-error {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #666;
    font-size: 1.1rem;
}

.chart-error {
    color: #F44336;
}
</style>
@endpush