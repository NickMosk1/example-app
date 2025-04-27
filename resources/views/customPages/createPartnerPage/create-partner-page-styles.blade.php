<style>
    .partner-creation-container {
        width: 500px;
        margin: 50px auto;
        padding: 20px;
        background-color: {{ $colors['WHITE'] }};
        border-radius: 10px;
        box-shadow: 0 4px 4px {{ $colors['LIGHT_GRAY'] }};
        text-align: center;
    }
    
    .create-partner-image-container {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }
    
    .create-partner-image {
        width: 180px;
        height: 180px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .create-partner-title {
        color: {{ $colors['DEFAULT_GRAY'] }};
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .partner-creation-container form div {
        margin-bottom: 15px;
        text-align: left;
    }
    
    .partner-creation-container label {
        display: block;
        margin-bottom: 5px;
        color: {{ $colors['DARK_GRAY'] }};
        font-family: 'Montserrat', sans-serif;
    }
    
    .partner-creation-container input,
    .partner-creation-container select {
        width: 100%;
        padding: 10px;
        border: 1px solid {{ $colors['LIGHT_GRAY'] }};
        border-radius: 5px;
        font-size: 1em;
        transition: border 0.3s ease, box-shadow 0.3s ease;
    }
    
    .partner-creation-container input:focus,
    .partner-creation-container select:focus {
        border-color: {{ $colors['GREEN'] }};
        outline: none;
        box-shadow: 0 4px 4px {{ $colors['GREEN'] }};
    }
    
    .create-partner-button {
        width: 100%;
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
        margin-top: 10px;
    }
    
    .create-partner-button:hover {
        background-color: {{ $colors['GREEN_HOVER'] }};
    }
    
    .home-button {
        width: 100%;
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
        margin-top: 10px;
    }
    
    .home-button:hover {
        background-color: {{ $colors['GREEN_HOVER'] }};
    }
    
    .create-partner-image.hovered {
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px {{ $colors['GREEN'] }};
    }
    
    .create-partner-title.hovered {
        transition: all 0.3s ease;
        color: {{ $colors['GREEN'] }};
    }
    
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.95em;
        transition: all 0.3s ease;
        border-left: 4px solid;
    }
    
    .alert-success {
        background-color: rgba(76, 175, 80, 0.15);
        color: {{ $colors['GREEN'] }};
        border-left-color: {{ $colors['GREEN'] }};
    }
    
    .alert-error {
        background-color: rgba(244, 67, 54, 0.15);
        color: {{ $colors['RED'] }};
        border-left-color: {{ $colors['RED'] }};
    }
    
    .error-message {
        color: {{ $colors['RED'] }};
        font-family: 'Montserrat', sans-serif;
        font-size: 0.8em;
        margin-top: 5px;
    }
</style>