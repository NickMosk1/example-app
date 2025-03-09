<style>
    .admin-panel-container {
        text-align: center;
        background-color: {{$colors['WHITE']}};
        padding: 40px;
        border-radius: 10px;
        width: 500px;
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
</style>