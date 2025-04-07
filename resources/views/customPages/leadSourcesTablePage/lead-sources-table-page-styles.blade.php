
<style>
    /* Основные стили таблицы */
    .sources-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        font-family: 'Montserrat', sans-serif;
    }

    .sources-table thead {
        background-color: {{$colors['BLUE']}};
        color: {{$colors['WHITE']}};
        font-weight: bold;
    }

    .sources-table th, .sources-table td {
        padding: 12px 15px;
        text-align: left;
        vertical-align: middle;
    }

    .sources-table tbody tr {
        color: {{$colors['DARK_GRAY']}};
        background-color: {{$colors['WHITE']}};
        transition: all 0.3s ease;
        border-bottom: 1px solid {{$colors['LIGHT_GRAY']}};
    }

    .sources-table tbody tr:last-child {
        border-bottom: none;
    }

    .sources-table tbody tr:hover {
        background-color: {{$colors['GREEN']}};
    }

    /* Бейджи типов источников */
    .source-type-badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.8em;
        font-weight: bold;
    }

    .source-type-badge.native {
        background-color: {{$colors['GREEN']}};
        color: {{$colors['WHITE']}};
    }

    .source-type-badge.external {
        background-color: {{$colors['ORANGE']}};
        color: {{$colors['WHITE']}};
    }

    /* Контактная информация */
    .contacts-info {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.9em;
    }

    /* Кнопка статистики */
    .btn-stats {
        background-color: {{$colors['PURPLE']}};
        color: {{$colors['WHITE']}};
        border: none;
        border-radius: 5px;
        padding: 8px 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.9em;
    }

    .btn-stats:hover {
        background-color: {{$colors['RED']}};
        transform: translateY(-2px);
    }

    /* Модальное окно статистики */
    .stats-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        backdrop-filter: blur(5px);
    }

    .stats-modal-content {
        width: 90%;
        max-width: 1200px;
        max-height: 90vh;
        background-color: {{$colors['WHITE']}};
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        overflow-y: auto;
        animation: modalFadeIn 0.3s ease-out;
    }

    .stats-modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid {{$colors['LIGHT_GRAY']}};
        background-color: {{$colors['BLUE']}};
        color: {{$colors['WHITE']}};
    }

    .close-modal {
        background: none;
        border: none;
        color: {{$colors['WHITE']}};
        font-size: 1.5em;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .close-modal:hover {
        transform: rotate(90deg);
    }

    /* Сетка статистики */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .stats-card {
        background-color: {{$colors['WHITE']}};
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .stats-card h4 {
        margin-top: 0;
        margin-bottom: 15px;
        color: {{$colors['DARK_GRAY']}};
        border-bottom: 1px solid {{$colors['LIGHT_GRAY']}};
        padding-bottom: 5px;
    }

    .stats-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .stats-row .value {
        font-weight: bold;
    }

    .profit .value.positive {
        color: {{$colors['GREEN']}};
    }

    .profit .value.negative {
        color: {{$colors['RED']}};
    }

    /* Стили для графиков */
    .chart-container {
        min-height: 300px;
    }

    /* Стили для списка топ заявок */
    .leads-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .lead-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: {{$colors['LIGHT_GRAY']}};
        border-radius: 5px;
    }

    .lead-id {
        font-weight: bold;
    }

    .lead-profit {
        color: {{$colors['GREEN']}};
        font-weight: bold;
    }

    @keyframes modalFadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>