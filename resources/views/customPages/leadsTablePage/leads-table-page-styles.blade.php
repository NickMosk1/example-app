<style>
    /* Существующие стили остаются без изменений */
    .leads-amount {
        color: {{$colors['GREEN']}};
        font-family: 'Montserrat', sans-serif;
        font-size: 1.2em;
        margin-top: 20px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .lead-table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
        border-radius: 8px;
        overflow: hidden;
        font-family: 'Montserrat', sans-serif;
    }

    .lead-table thead {
        background-color: {{$colors['GREEN']}};
        color: {{$colors['WHITE']}};
        font-weight: bold;
    }

    .lead-table th, .lead-table td {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }

    .lead-table tbody tr {
        color: {{$colors['DARK_GRAY']}};
        background-color: {{$colors['WHITE']}};
        transition: all 0.3s ease;
    }

    .lead-table tbody tr:hover {
        color: {{$colors['LIGHT_GREEN']}};
        background-color: {{$colors['GREEN_HOVER']}};
    }

    .lead-table tbody tr:nth-child(even) {
        background-color: {{$colors['LIGHT_GREEN']}};
    }

    .lead-table tbody tr:nth-child(even):hover {
        background-color: {{$colors['GREEN_HOVER']}};
    }

    .status-cell {
        text-align: center; 
        vertical-align: middle;
    }

    .status-badge {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 5px;
        color: {{$colors['WHITE']}};
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .status-pending { background-color: {{$colors['ORANGE']}}; }
    .status-in_progress { background-color: {{$colors['BLUE']}}; }
    .status-sold_to_partner { background-color: {{$colors['GREEN']}}; }
    .status-cancelled { background-color: {{$colors['RED']}}; }

    .pagination {
        display: flex;
        gap: 5px;
    }

    .pagination a {
        padding: 10px 15px;
        background-color: {{$colors['GREEN']}};
        color: {{$colors['WHITE']}};
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .pagination a:hover {
        background-color: {{$colors['GREEN_HOVER']}};
    }

    .pagination .active {
        background-color: {{$colors['GREEN_HOVER']}};
        font-weight: bold;
    }

    .pagination .disabled, .pagination .disabled:hover {
        background-color: {{$colors['WHITE']}};
        cursor: not-allowed;
    }

    /* Новые стили для функционала редактирования */
    .action-buttons {
        display: flex;
        gap: 18px;
        justify-content: center;
    }

    .btn-action {
        border: none;
        background: none;
        cursor: pointer;
        padding: 5px;
        border-radius: 50%;
        width: 32px;
        height: 32px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;

    }

    .btn-edit {
    color: {{$colors['BLUE']}};
    background-color: {{$colors['BLACK']}}20; /* HEX с прозрачностью 12.5% */
    margin-right: 8px
    }       

    .btn-delete {
    color: {{$colors['RED']}};
    background-color: {{$colors['BLACK']}}20; /* HEX с прозрачностью 12.5% */
    }
    .btn-action:hover {
        transform: scale(1.1);
        box-shadow: 0 2px 4px {{$colors['LIGHT_GRAY']}};
    }

    /* Стили для модального окна */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .modal-content {
        background: {{$colors['WHITE']}};
        padding: 2rem;
        border-radius: 12px;
        width: 500px;
        max-width: 95%;
        box-shadow: 0 4px 8px {{$colors['LIGHT_GRAY']}};
    }

    .modal-content h3 {
        color: {{$colors['DARK_GRAY']}};
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        color: {{$colors['DARK_GRAY']}};
        font-weight: 500;
    }

    .form-input {
        width: 100%;
        padding: 0.8rem;
        border: 2px solid {{$colors['LIGHT_GREEN']}};
        border-radius: 8px;
        font-family: 'Montserrat', sans-serif;
        transition: border-color 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: {{$colors['GREEN']}};
    }

    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1em;
    }

    .modal-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
    }

    .btn-primary {
        background-color: {{$colors['GREEN']}};
        color: {{$colors['WHITE']}};
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: {{$colors['GREEN_HOVER']}};
    }

    .btn-secondary {
        background-color: {{$colors['LIGHT_GREEN']}};
        color: {{$colors['DARK_GRAY']}};
        padding: 0.8rem 1.5rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: {{$colors['LIGHT_GRAY']}};
    }

    .error-message {
        color: {{$colors['RED']}};
        font-size: 0.875rem;
        margin-top: 0.5rem;
        display: block;
    }

    /* Анимация модального окна */
    @keyframes modalEnter {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .modal-content {
        animation: modalEnter 0.3s ease-out;
    }
</style>