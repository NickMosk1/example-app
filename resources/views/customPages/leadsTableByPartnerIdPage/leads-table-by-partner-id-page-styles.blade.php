<style>
    .leads-amount {
        color: {{ $colors['GREEN'] }};
        font-family: 'Montserrat', sans-serif;
        font-size: 1.2em;
        margin-top: 20px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .table-container {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        box-shadow: 0 4px 4px {{ $colors['LIGHT_GRAY'] }};
        border-radius: 8px;
        margin-top: 20px;
        font-family: 'Montserrat', sans-serif;
    }

    .lead-table {
        width: 100%;
        min-width: 1000px;
        border-collapse: collapse;
    }

    .lead-table thead {
        background-color: {{ $colors['GREEN'] }};
        color: {{ $colors['WHITE'] }};
        font-weight: bold;
    }

    .lead-table th, .lead-table td {
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }

    .lead-table tbody tr {
        color: {{ $colors['DARK_GRAY'] }};
        background-color: {{ $colors['WHITE'] }};
        transition: all 0.3s ease;
    }

    .lead-table tbody tr:hover {
        color: {{ $colors['LIGHT_GREEN'] }};
        background-color: {{ $colors['GREEN_HOVER'] }};
    }

    .lead-table tbody tr:nth-child(even) {
        background-color: {{ $colors['LIGHT_GREEN'] }};
    }

    .lead-table tbody tr:nth-child(even):hover {
        background-color: {{ $colors['GREEN_HOVER'] }};
    }

    .status-cell {
        text-align: center; 
        vertical-align: middle;
    }

    .status-badge {
        display: inline-block;
        padding: 8px 15px;
        border-radius: 5px;
        color: {{ $colors['WHITE'] }};
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .status-pending { background-color: {{ $colors['ORANGE'] }}; }
    .status-in_progress { background-color: {{ $colors['BLUE'] }}; }
    .status-sold_to_partner { background-color: {{ $colors['GREEN'] }}; }
    .status-cancelled { background-color: {{ $colors['RED'] }}; }

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

    .btn-action:hover {
        transform: scale(1.1);
        box-shadow: 0 2px 4px {{ $colors['LIGHT_GRAY'] }};
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
        background-color: {{ $colors['WHITE'] }};
        border-radius: 10px;
        box-shadow: 0 4px 4px {{ $colors['LIGHT_GRAY'] }};
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
        color: {{ $colors['DEFAULT_GRAY'] }};
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
        color: {{ $colors['DARK_GRAY'] }};
        font-family: 'Montserrat', sans-serif;
    }

    .modal-content input,
    .modal-content select,
    .modal-content textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid {{ $colors['LIGHT_GRAY'] }};
        border-radius: 5px;
        font-size: 1em;
        transition: all 0.3s ease;
        font-family: 'Montserrat', sans-serif;
    }

    .modal-content textarea {
        min-height: 80px;
        resize: vertical;
    }

    .modal-content input:focus,
    .modal-content select:focus,
    .modal-content textarea:focus {
        border-color: {{ $colors['GREEN'] }};
        outline: none;
        box-shadow: 0 4px 4px {{ $colors['GREEN'] }};
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .modal-save-button {
        flex: 1;
        padding: 10px 20px;
        background-color: {{ $colors['GREEN'] }};
        color: {{ $colors['WHITE'] }};
        font-weight: bold;
        font-family: 'Montserrat', sans-serif;
        border: none;
        border-radius: 5px;
        font-size: 1em;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .modal-save-button:hover {
        background-color: {{ $colors['GREEN_HOVER'] }};
    }

    .modal-cancel-button {
        flex: 1;
        padding: 10px 20px;
        background-color: {{ $colors['LIGHT_GRAY'] }};
        color: {{ $colors['DARK_GRAY'] }};
        font-weight: bold;
        font-family: 'Montserrat', sans-serif;
        border: none;
        border-radius: 5px;
        font-size: 1em;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .modal-cancel-button:hover {
        background-color: {{ $colors['DEFAULT_GRAY'] }};
        color: {{ $colors['WHITE'] }};
    }

    .error-message {
        color: {{ $colors['RED'] }};
        font-family: 'Montserrat', sans-serif;
        font-size: 0.9em;
        margin-top: 5px;
        display: block;
    }

    .btn-reject {
        color: {{$colors['DEFAULT_GRAY']}};
        display: flex;
        margin-right: 10px;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .btn-reject:hover {
        transform: scale(1.1);
        color: {{$colors['RED']}};
        transition: all 0.3s ease;
    }

    @keyframes modalEnter {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .modal-save-button:hover + .modal-image-container .modal-image,
    .modal-save-button:hover ~ .modal-title {
        color: {{ $colors['GREEN'] }};
    }

    .modal-save-button:hover + .modal-image-container .modal-image {
        box-shadow: 0 4px 12px {{ $colors['GREEN'] }};
    }

    .import-export-buttons {
        display: flex;
        gap: 15px;
    }

    .admin-button {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 24px;
        background-color: {{ $colors['GREEN'] }};
        color: {{ $colors['WHITE'] }};
        font-weight: bold;
        font-family: 'Montserrat', sans-serif;
        border: none;
        border-radius: 5px;
        font-size: 1em;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .admin-button:hover {
        background-color: {{ $colors['GREEN_HOVER'] }};
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .button-icon {
        width: 18px;
        height: 18px;
    }

    .file-upload-wrapper {
        margin: 20px 0;
    }

    .file-upload-label {
        display: flex;
        align-items: center;
        width: 100%;
    }

    .file-upload-input {
        display: none;
    }

    .file-upload-text {
        flex-grow: 1;
        padding: 12px;
        background-color: {{ $colors['WHITE'] }};
        border: 1px solid {{ $colors['LIGHT_GRAY'] }};
        border-right: none;
        border-radius: 5px 0 0 5px;
        font-family: 'Montserrat', sans-serif;
    }

    .file-upload-button {
        padding: 12px 20px;
        background-color: {{ $colors['GREEN'] }};
        color: {{ $colors['WHITE'] }};
        border-radius: 0 5px 5px 0;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .file-upload-button:hover {
        background-color: {{ $colors['GREEN_HOVER'] }};
    }

    .loading-spinner {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .spinner-icon {
        width: 18px;
        height: 18px;
        animation: rotate 1.4s linear infinite;
    }

    .spinner-path {
        stroke: {{ $colors['WHITE'] }};
        stroke-linecap: round;
        animation: dash 1.4s ease-in-out infinite;
    }

    @keyframes rotate {
        100% { transform: rotate(360deg); }
    }

    @keyframes dash {
        0% { stroke-dasharray: 1, 150; stroke-dashoffset: 0; }
        50% { stroke-dasharray: 90, 150; stroke-dashoffset: -35; }
        100% { stroke-dasharray: 90, 150; stroke-dashoffset: -124; }
    }

    .modal-header {
        position: relative;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .source-cell {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .source-name {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }

    .native-badge {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: {{ $colors['GREEN'] }};
        margin-left: 5px;
    }

    .no-source {
        color: #999;
        font-style: italic;
    }

    .no-partner {
        color: #999;
        font-style: italic;
    }

    .price-cell {
        font-weight: bold;
    }

    .no-price {
        color: #999;
        font-style: italic;
    }
</style>