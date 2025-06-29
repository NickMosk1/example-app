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

    .modal-content input:focus,
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
        background-color: {{$colors['GREEN']}};
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

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    .users-list {
        max-height: 300px;
        overflow-y: auto;
        padding-right: 5px;
    }

    .user-item {
        display: flex;
        align-items: center;
        padding: 12px;
        margin-bottom: 10px;
        background-color: {{$colors['WHITE']}};
        border-radius: 8px;
        border: 1px solid {{$colors['LIGHT_GRAY']}};
        transition: all 0.3s ease;
    }

    .user-item:hover {
        background-color: {{$colors['LIGHT_GREEN']}};
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: {{$colors['LIGHT_GRAY']}};
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        overflow: hidden;
    }

    .user-details {
        flex: 1;
    }

    .user-name {
        font-weight: 600;
        color: {{$colors['DARK_GRAY']}};
        font-family: 'Montserrat', sans-serif;
        margin-bottom: 3px;
    }

    .user-email {
        font-size: 12px;
        color: {{$colors['DEFAULT_GRAY']}};
        font-family: 'Montserrat', sans-serif;
        margin-bottom: 5px;
    }

    .user-meta {
        display: flex;
        justify-content: space-between;
        font-size: 11px;
    }

    .user-role {
        padding: 3px 8px;
        border-radius: 12px;
        font-weight: bold;
        font-size: 10px;
        text-transform: uppercase;
        color: {{$colors['WHITE']}};
        background-color: {{$colors['GREEN']}};
    }

    .user-date {
        color: {{$colors['DEFAULT_GRAY']}};
        font-size: 11px;
    }

    .no-users {
        text-align: center;
        padding: 20px;
        color: {{$colors['DEFAULT_GRAY']}};
        font-family: 'Montserrat', sans-serif;
    }

    .users-list::-webkit-scrollbar {
        width: 6px;
    }

    .users-list::-webkit-scrollbar-track {
        background: {{$colors['LIGHT_GRAY']}};
        border-radius: 3px;
    }

    .users-list::-webkit-scrollbar-thumb {
        background: {{$colors['GREEN']}};
        border-radius: 3px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .user-item {
        animation: fadeIn 0.3s ease-out forwards;
    }
</style>