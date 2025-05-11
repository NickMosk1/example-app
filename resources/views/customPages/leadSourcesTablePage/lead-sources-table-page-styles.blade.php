
<style>
    .sources-amount {
        color: {{$colors['GREEN']}};
        font-family: 'Montserrat', sans-serif;
        font-size: 1.2em;
        margin-top: 20px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .sources-table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
        border-radius: 8px;
        overflow: hidden;
        font-family: 'Montserrat', sans-serif;
    }

    .sources-table thead {
        background-color: {{$colors['GREEN']}};
        color: {{$colors['WHITE']}};
        font-weight: bold;
    }

    .sources-table th, .sources-table td {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }

    .sources-table tbody tr {
        color: {{$colors['DARK_GRAY']}};
        background-color: {{$colors['WHITE']}};
        transition: all 0.3s ease;
    }

    .sources-table tbody tr:hover {
        color: {{$colors['WHITE']}};
        background-color: {{$colors['GREEN_HOVER']}};
    }

    .sources-table tbody tr:nth-child(even) {
        background-color: {{$colors['LIGHT_GREEN']}};
    }

    .sources-table tbody tr:nth-child(even):hover {
        background-color: {{$colors['GREEN_HOVER']}};
    }

    .source-type-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8em;
        font-weight: bold;
        color: {{$colors['WHITE']}};
    }

    .source-type-badge.native {
        background-color: {{$colors['BLUE']}};
    }

    .source-type-badge.external {
        background-color: {{$colors['PURPLE']}};
    }

    .no-price {
        color: {{$colors['LIGHT_GRAY']}};
        font-style: italic;
    }

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
        justify-content: center;
    }

    .actions-cell {
        padding: 0.5rem;
        text-align: center;
    }

    .record-button-container {
        display: flex !important;
        align-items: center;
        justify-content: center;
        flex-direction: row;
    }

    .btn-edit {
        color: {{$colors['DEFAULT_GRAY']}};
        display: flex;
        margin-right: 10px;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        transform: scale(1.1);
        color: {{$colors['WHITE']}};
        transition: all 0.3s ease;
    }

    .btn-stats {
        color: {{$colors['DEFAULT_GRAY']}};
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        transition: all 0.3s ease;
    }

    .btn-stats:hover {
        transform: scale(1.08);
        color: {{$colors['WHITE']}};
        transition: all 0.3s ease;
    }

    .btn-delete {
        margin-right: 10px;
        display: flex;
        color: {{$colors['DEFAULT_GRAY']}};
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }    

    .btn-delete:hover {
        transform: scale(1.1);
        color: {{$colors['WHITE']}};
        transition: all 0.3s ease;
    }

    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .modal-content {
        width: 90%;
        max-width: 1200px;
        max-height: 90vh;
        overflow-y: auto;
        margin: 20px auto;
        padding: 20px;
        background-color: {{$colors['WHITE']}};
        border-radius: 10px;
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
        animation: modalEnter 0.3s ease-out;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid {{$colors['LIGHT_GRAY']}};
    }

    .modal-title {
        color: {{$colors['DARK_GRAY']}};
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        margin: 0;
    }

    .close-modal {
        background: none;
        border: none;
        font-size: 1.5em;
        cursor: pointer;
        color: {{$colors['DARK_GRAY']}};
        transition: all 0.3s ease;
    }

    .close-modal:hover {
        color: {{$colors['RED']}};
        transform: scale(1.2);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .stats-card {
        background-color: {{$colors['WHITE']}};
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 4px {{$colors['LIGHT_GRAY']}};
    }

    .stats-card h4 {
        color: {{$colors['GREEN']}};
        font-family: 'Montserrat', sans-serif;
        margin-top: 0;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid {{$colors['LIGHT_GRAY']}};
    }

    .stats-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-family: 'Montserrat', sans-serif;
    }

    .stats-row .value {
        font-weight: bold;
        color: {{$colors['DARK_GRAY']}};
    }

    .stats-row.profit .value {
        font-size: 1.1em;
    }

    .stats-row.profit .value.positive {
        color: {{$colors['GREEN']}};
    }

    .stats-row.profit .value.negative {
        color: {{$colors['RED']}};
    }

    .chart-container {
        position: relative;
        padding: 15px;
    }

    .chart-wrapper {
        position: relative;
        width: 100%;
        min-height: 300px;
    }

    canvas {
        width: 100% !important;
        height: auto !important;
    }

    .leads-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .leads-list.scrollable {
        max-height: 300px;
        overflow-y: auto;
    }

    .lead-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: {{$colors['LIGHT_GREEN']}};
        border-radius: 5px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.9em;
    }

    .lead-id {
        font-weight: bold;
        color: {{$colors['DARK_GRAY']}};
    }

    .lead-profit {
        color: {{$colors['GREEN']}};
        font-weight: bold;
    }

    .lead-dates {
        color: {{$colors['DEFAULT_GRAY']}};
        font-size: 0.8em;
    }

    .lead-status {
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 0.8em;
        font-weight: bold;
        color: {{$colors['WHITE']}};
    }

    .lead-status.pending {
        background-color: {{$colors['ORANGE']}};
    }

    .lead-status.in-progress {
        background-color: {{$colors['BLUE']}};
    }

    .lead-status.sold-to-partner {
        background-color: {{$colors['GREEN']}};
    }

    .lead-status.cancelled {
        background-color: {{$colors['RED']}};
    }

    @keyframes modalEnter {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .pagination {
        display: flex;
        gap: 5px;
        justify-content: center;
        margin-top: 20px;
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

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .modal-body {
        padding: 10px 0;
    }

    .form-group {
        margin-bottom: 15px;
        text-align: left;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: {{$colors['DARK_GRAY']}};
        font-family: 'Montserrat', sans-serif;
    }

    .form-input {
        width: 100%;
        padding: 10px;
        border: 1px solid {{$colors['LIGHT_GRAY']}};
        border-radius: 5px;
        font-size: 1em;
        transition: all 0.3s ease;
        font-family: 'Montserrat', sans-serif;
    }

    .form-input:focus {
        border-color: {{$colors['GREEN']}};
        outline: none;
        box-shadow: 0 4px 4px {{$colors['GREEN']}};
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .btn-save {
        width: 100%;
        padding: 10px 20px;
        background-color: {{$colors['GREEN']}};
        color: {{$colors['WHITE']}};
        font-weight: bold;
        font-family: 'Montserrat', sans-serif;
        border: none;
        border-radius: 5px;
        font-size: 1em;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-save:hover {
        background-color: {{$colors['GREEN_HOVER']}};
    }

    .btn-cancel {
        width: 100%;
        padding: 10px 20px;
        background-color: {{$colors['LIGHT_GRAY']}};
        color: {{$colors['DARK_GRAY']}};
        font-weight: bold;
        font-family: 'Montserrat', sans-serif;
        border: none;
        border-radius: 5px;
        font-size: 1em;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-cancel:hover {
        background-color: {{$colors['DEFAULT_GRAY']}};
        color: {{$colors['WHITE']}};
    }

    .error-message {
        color: {{$colors['RED']}};
        font-family: 'Montserrat', sans-serif;
        font-size: 0.9em;
        margin-top: 5px;
        display: block;
    }

    .alert {
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        text-align: center;
        font-family: 'Montserrat', sans-serif;
    }

    .alert-success {
        color: {{$colors['GREEN']}};
        background-color: {{$colors['LIGHT_GREEN']}};
    }

    .alert-error {
        color: {{$colors['RED']}};
        background-color: {{$colors['WHITE']}};
    }

    @keyframes modalEnter {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>