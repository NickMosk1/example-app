<style>
    .partners-amount {
        color: {{$colors['GREEN']}};
        font-family: 'Montserrat', sans-serif;
        font-size: 1.2em;
        margin-top: 20px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .partner-table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
        margin-top: 20px;
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
        border-radius: 8px;
        overflow: hidden;
        font-family: 'Montserrat', sans-serif;
    }

    .partner-table thead {
        background-color: {{$colors['GREEN']}};
        color: {{$colors['WHITE']}};
        font-weight: bold;
    }

    .partner-table th, .partner-table td {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }

    .partner-table tbody tr {
        color: {{$colors['DARK_GRAY']}};
        background-color: {{$colors['WHITE']}};
        transition: all 0.3s ease;
    }

    .partner-table tbody tr:hover {
        color: {{$colors['WHITE']}};
        background-color: {{$colors['GREEN_HOVER']}};
    }

    .partner-table tbody tr:nth-child(even) {
        background-color: {{$colors['LIGHT_GREEN']}};
    }

    .partner-table tbody tr:nth-child(even):hover {
        background-color: {{$colors['GREEN_HOVER']}};
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

    td.actions-cell {
        padding: 0.5rem;
        text-align: center;
    }   

    .record-button-container {
        display: flex !important;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        width: 100px;
    }

    .btn-edit {
        margin-right: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .btn-edit:hover {
        transform: scale(1.1);
        transition: all 0.3s ease;
    }

    .btn-delete {
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }    

    .btn-delete:hover {
        transform: scale(1.1);
        transition: all 0.3s ease;
    }

    .edit-image {
        width: 20px;
        height: 20px;
    }

    .delete-image {
        width: 25px;
        height: 25px;
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
        width: 500px;
        margin: 20px auto;
        padding: 20px;
        background-color: {{$colors['WHITE']}};
        border-radius: 10px;
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
        text-align: center;
        animation: modalEnter 0.3s ease-out;
    }

    .modal-image-container {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .modal-image {
        width: 120px;
        height: 120px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .modal-title {
        color: {{$colors['DEFAULT_GRAY']}};
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .modal-content form div {
        margin-bottom: 15px;
        text-align: left;
    }

    .modal-content label {
        display: block;
        margin-bottom: 5px;
        color: {{$colors['DARK_GRAY']}};
        font-family: 'Montserrat', sans-serif;
    }

    .modal-content input,
    .modal-content textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid {{$colors['LIGHT_GRAY']}};
        border-radius: 5px;
        font-size: 1em;
        transition: all 0.3s ease;
        font-family: 'Montserrat', sans-serif;
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .modal-save-button {
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

    .modal-save-button:hover {
        background-color: {{$colors['GREEN_HOVER']}};
    }

    .modal-cancel-button {
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

    .modal-cancel-button:hover {
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

    .success {
        color: {{$colors['GREEN']}};
        font-family: 'Montserrat', sans-serif;
        margin-bottom: 15px;
        padding: 10px;
        background-color: {{$colors['LIGHT_GREEN']}};
        border-radius: 5px;
        text-align: center;
    }

    .error {
        color: {{$colors['RED']}};
        font-family: 'Montserrat', sans-serif;
        margin-bottom: 15px;
        padding: 10px;
        background-color: {{ $colors['WHITE'] }};
        border-radius: 5px;
        text-align: center;
    }

    .modal-image.hovered {
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px {{ $colors['GREEN'] }};
    }

    .modal-title.hovered {
        transition: all 0.3s ease;
        color: {{$colors['GREEN']}};
    }

    @keyframes modalEnter {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
</style>