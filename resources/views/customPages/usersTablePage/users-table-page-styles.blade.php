<style>
    .user-table {
        width: 100%;
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
        text-align: left;
    }

    .user-table tbody tr {
        background-color: {{ $colors['LIGHT_GRAY'] }};
        transition: background-color 0.3s ease;
    }

    .user-table tbody tr:hover {
        background-color: {{ $colors['CYAN'] }};
    }

    .user-table tbody tr:nth-child(even) {
        background-color: {{ $colors['SILVER'] }};
    }

    input:focus, select:focus {
        border: 1px solid {{ $colors['GREEN'] }};
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
        outline: none;
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
        background-color: {{ $colors['DARK_GRAY'] }};
        cursor: not-allowed;
    }
</style>