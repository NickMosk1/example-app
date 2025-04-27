<style>
    .admin-panel-container {
        text-align: center;
        background-color: {{$colors['WHITE']}};
        padding: 40px;
        border-radius: 10px;
        width: 850px;
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
        transition: all 0.3s ease;
    }
    .admin-panel-image-container {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        transition: all 0.3s ease;
    }

    .admin-panel-image {
        width: 180px;
        height: 180px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .admin-panel-title {
        color: {{$colors['DEFAULT_GRAY']}};
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }
    .button-group {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    .admin-button {
        padding: 15px 30px;
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
    }
    .admin-panel-image.hovered {
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px {{ $colors['GREEN'] }};
    }
    .admin-panel-title.hovered {
        transition: all 0.3s ease;
        color: {{$colors['GREEN']}};
    }

    .admin-dashboard {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: repeat(2, 1fr);
        gap: 30px;
        padding: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .admin-panel {
        background-color: {{$colors['WHITE']}};
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 6px 15px {{$colors['LIGHT_GRAY']}};
        transition: all 0.3s ease;
        position: relative;
        transform: translateY(0);
        animation: floatUp 0.5s ease-out forwards;
        opacity: 0;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* Остальные стили остаются без изменений */
    @keyframes floatUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .admin-panel:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px {{$colors['GREEN_HOVER']}};
    }

    .admin-panel:nth-child(1) { 
        animation-delay: 0.1s; 
        grid-column: 1;
        grid-row: 1;
    }
    .admin-panel:nth-child(2) { 
        animation-delay: 0.2s;
        grid-column: 2;
        grid-row: 1;
    }
    .admin-panel:nth-child(3) { 
        animation-delay: 0.3s;
        grid-column: 1;
        grid-row: 2;
    }
    .admin-panel:nth-child(4) { 
        animation-delay: 0.4s;
        grid-column: 2;
        grid-row: 2;
    }

    .admin-panel-image-container {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        transition: all 0.3s ease;
        position: relative;
    }

    .admin-panel-image {
        width: 180px;
        height: 180px;
        border-radius: 12px;
        transition: all 0.3s ease;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .panel-shadow {
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 70%;
        height: 20px;
        background: rgba(0, 0, 0, 0.1);
        filter: blur(12px);
        border-radius: 50%;
        z-index: -1;
        transition: all 0.3s ease;
    }

    .admin-panel:hover .panel-shadow {
        bottom: -15px;
        width: 80%;
        filter: blur(15px);
    }

    .admin-panel-title {
        color: {{$colors['DEFAULT_GRAY']}};
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        margin-bottom: 25px;
        font-size: 1.5rem;
        transition: all 0.3s ease;
    }

    .button-group {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .admin-button {
        padding: 15px 30px;
        background-color: {{$colors['GREEN']}};
        color: {{$colors['WHITE']}};
        font-weight: bold;
        font-family: 'Montserrat', sans-serif;
        border: none;
        border-radius: 8px;
        font-size: 1em;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .admin-button:hover {
        background-color: {{$colors['GREEN_HOVER']}};
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .admin-panel-image.hovered {
        box-shadow: 0 4px 12px {{$colors['GREEN']}};
    }

    .admin-panel-title.hovered {
        color: {{$colors['GREEN']}};
    }

    /* Цветовые акценты для панелей */
    .user-panel .admin-button {
        background-color: {{$colors['GREEN']}};
    }
    .user-panel .admin-button:hover {
        background-color: {{$colors['GREEN_HOVER']}};
    }
    .user-panel:hover .admin-panel-title {
        color: {{$colors['GREEN']}};
    }

    .lead-panel .admin-button {
        background-color: {{$colors['GREEN']}};
    }
    .lead-panel .admin-button:hover {
        background-color: {{$colors['GREEN_HOVER']}};
    }
    .lead-panel:hover .admin-panel-title {
        color: {{$colors['GREEN']}};
    }

    .source-panel .admin-button {
        background-color: {{$colors['GREEN']}};
    }
    .source-panel .admin-button:hover {
        background-color: {{$colors['GREEN_HOVER']}};
    }
    .source-panel:hover .admin-panel-title {
        color: {{$colors['GREEN']}};
    }

    .partner-panel .admin-button {
        background-color: {{$colors['GREEN']}};
    }
    .partner-panel .admin-button:hover {
        background-color: {{$colors['GREEN_HOVER']}};
    }
    .partner-panel:hover .admin-panel-title {
        color: {{$colors['GREEN']}};
    }
</style>