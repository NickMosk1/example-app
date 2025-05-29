<style>
    .leads-amount {
        color: {{$colors['GREEN']}};
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
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
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
        box-shadow: 0 2px 4px {{$colors['LIGHT_GRAY']}};
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
    .modal-content select,
    .modal-content textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid {{$colors['LIGHT_GRAY']}};
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
        border-color: {{$colors['GREEN']}};
        outline: none;
        box-shadow: 0 4px 4px {{$colors['GREEN']}};
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .modal-save-button {
        flex: 1;
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
        flex: 1;
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

    @keyframes modalEnter {
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .modal-save-button:hover + .modal-image-container .modal-image,
    .modal-save-button:hover ~ .modal-title {
        color: {{$colors['GREEN']}};
    }

    .modal-save-button:hover + .modal-image-container .modal-image {
        box-shadow: 0 4px 12px {{$colors['GREEN']}};
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

    .admin-button:hover {
        background-color: {{$colors['GREEN_HOVER']}};
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .button-icon {
        width: 18px;
        height: 18px;
    }

    .upload-progress {
        margin-top: 10px;
        display: none;
    }

    [wire:loading].upload-progress,
    [wire:loading][wire:target="importFile"].upload-progress {
        display: block;
    }

    .progress-bar {
        width: 100%;
        height: 6px;
        background-color: #f0f0f0;
        border-radius: 3px;
        overflow: hidden;
    }

    .progress {
        height: 100%;
        width: 0;
        background-color: #4CAF50;
        animation: progress 2s ease-in-out infinite;
    }

    .progress-text {
        margin-top: 5px;
        font-size: 12px;
        color: #666;
    }

    @keyframes progress {
        0% { width: 0; }
        50% { width: 50%; }
        100% { width: 100%; }
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
        stroke: {{$colors['WHITE']}};
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
        background-color: {{$colors['GREEN']}};
        margin-left: 5px;
    }

    .no-source {
        color: {{$colors['DARK_GRAY']}};
        font-style: italic;
    }

    .filters-container {
        margin-top: 20px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        padding: 15px;
        background-color: {{$colors['LIGHT_GREEN']}};
        border-radius: 8px;
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
    }

    .filter-group {
        display: flex;
        flex-direction: column;
    }

    .filter-label {
        margin-bottom: 5px;
        color: {{$colors['DARK_GRAY']}};
        font-weight: 500;
    }

    .filter-select {
        padding: 8px 12px;
        border: 1px solid {{$colors['LIGHT_GRAY']}};
        border-radius: 5px;
        background-color: {{$colors['WHITE']}};
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .filter-select:hover {
        border-color: {{$colors['GREEN']}};
    }

    .filter-select:focus {
        outline: none;
        border-color: {{$colors['GREEN']}};
        box-shadow: 0 0 0 2px rgba({{$colors['GREEN']}}, 0.2);
    }

    .filter-reset {
        align-self: flex-end;
    }

    .reset-button {
        padding: 8px 15px;
    }

    .pagination-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .pagination-info {
        color: {{$colors['DARK_GRAY']}};
        font-size: 0.9em;
    }

    .pagination {
        display: flex;
        gap: 5px;
    }

    .pagination a, .pagination span {
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

    .pagination .disabled {
        background-color: {{$colors['WHITE']}};
        color: {{$colors['DARK_GRAY']}};
        cursor: not-allowed;
    }

    .per-page-selector {
        display: flex;
        align-items: center;
    }

    .per-page-label {
        margin-right: 10px;
        color: {{$colors['DARK_GRAY']}};
    }

    .per-page-select {
        padding: 5px 10px;
        border: 1px solid {{$colors['LIGHT_GRAY']}};
        border-radius: 5px;
        background-color: {{$colors['WHITE']}};
    }

    @media (max-width: 768px) {
        .pagination-container {
            flex-direction: column;
            align-items: stretch;
        }
        
        .pagination {
            justify-content: center;
            margin: 10px 0;
        }
        
        .per-page-selector {
            justify-content: center;
        }
    }

    .page-link {
        padding: 10px 15px;
        background-color: {{$colors['GREEN']}};
        color: {{$colors['WHITE']}};
        border-radius: 5px;
        text-decoration: none;
        transition: background-color 0.3s;
        border: none;
        cursor: pointer;
        font-family: inherit;
        font-size: inherit;
    }

    .page-link:hover {
        background-color: {{$colors['GREEN_HOVER']}};
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

</style>