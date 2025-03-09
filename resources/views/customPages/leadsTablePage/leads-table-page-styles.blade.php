<style>
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
    .status-pending {
        background-color: {{$colors['PURPLE']}};
    }
    .status-in_progress {
        background-color: {{$colors['BLUE']}};
    }
    .status-sold_to_partner {
        background-color: {{$colors['ORANGE']}};
    }
    .status-cancelled {
        background-color: {{$colors['RED']}};
    }
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
</style>