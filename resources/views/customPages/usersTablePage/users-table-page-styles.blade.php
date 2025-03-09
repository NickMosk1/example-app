<style>
    .users-amount {
        color: {{$colors['GREEN']}};
        font-family: 'Montserrat', sans-serif;
        font-size: 1.2em;
        margin-top: 20px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }
    .user-table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
        border-radius: 8px;
        overflow: hidden;
        font-family: 'Montserrat', sans-serif;
    }
    .user-table thead {
        background-color: {{ $colors['GREEN'] }};
        color: {{ $colors['WHITE'] }};
        font-weight: bold;
    }
    .user-table th, .user-table td {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }
    .user-table tbody tr {
        color: {{ $colors['GREEN'] }};
        background-color: {{ $colors['WHITE'] }};
        transition: all 0.3s ease;
    }
    .user-table tbody tr:hover {
        color: {{ $colors['LIGHT_GREEN'] }};
        background-color: {{ $colors['GREEN_HOVER'] }};
    }
    .user-table tbody tr:nth-child(even) {
        color: {{ $colors['GREEN_HOVER'] }};
        background-color: {{ $colors['LIGHT_GREEN'] }};
        transition: all 0.3s ease;
    }
    .user-table tbody tr:nth-child(even):hover {
        color: {{ $colors['LIGHT_GREEN'] }};
        background-color: {{ $colors['GREEN_HOVER'] }};
    }
    .pagination {
        display: flex;
        gap: 5px;
    }
    .pagination a {
        padding: 10px 15px;
        background-color: {{ $colors['GREEN'] }};
        color: {{ $colors['WHITE'] }};
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
    }
    .pagination a:hover {
        background-color: {{ $colors['GREEN_HOVER'] }};
    }
    .pagination .active {
        background-color: {{ $colors['GREEN_HOVER'] }};
        font-weight: bold;
    }
    .pagination .disabled, .pagination .disabled:hover {
        background-color: {{ $colors['WHITE'] }};
        cursor: not-allowed;
    }
</style>