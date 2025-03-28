<style>
    .user-creation-container {
        width: 500px;
        margin: 50px auto;
        padding: 20px;
        background-color: {{ $colors['WHITE'] }};
        border-radius: 10px;
        box-shadow: 0 4px 4px {{ $colors['LIGHT_GRAY'] }};
        text-align: center;
    }
    
    .roles-selection {
        margin-bottom: 20px;
        text-align: left;
    }
    
    .roles-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }
    
    .role-option {
        position: relative;
    }
    
    .role-checkbox {
        position: absolute;
        opacity: 0;
    }
    
    .role-label {
        display: inline-block;
        padding: 8px 15px;
        background-color: {{ $colors['WHITE'] }};
        color: {{ $colors['DARK_GRAY'] }};
        border: 1px solid {{ $colors['LIGHT_GRAY'] }};
        border-radius: 20px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.9em;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .role-checkbox:checked + .role-label {
        background-color: {{ $colors['GREEN'] }};
        color: {{ $colors['WHITE'] }};
        border-color: {{ $colors['GREEN'] }};
    }
    
    .role-checkbox:focus + .role-label {
        box-shadow: 0 0 0 2px {{ $colors['GREEN'] }};
    }
    
    .role-label:hover {
        background-color: {{ $colors['LIGHT_GRAY'] }};
    }
    
    .error-message {
        color: {{ $colors['RED'] }};
        font-family: 'Montserrat', sans-serif;
        font-size: 0.8em;
        margin-top: 5px;
    }
    
    .create-user-image-container {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }
    
    .create-user-image {
        width: 180px;
        height: 180px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .create-user-title {
        color: {{ $colors['DEFAULT_GRAY'] }};
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .user-creation-container form div {
        margin-bottom: 15px;
        text-align: left;
    }
    
    .user-creation-container label {
        display: block;
        margin-bottom: 5px;
        color: {{ $colors['DARK_GRAY'] }};
        font-family: 'Montserrat', sans-serif;
    }
    
    .user-creation-container input,
    .user-creation-container select {
        width: 100%;
        padding: 10px;
        border: 1px solid {{ $colors['LIGHT_GRAY'] }};
        border-radius: 5px;
        font-size: 1em;
        transition: border 0.3s ease, box-shadow 0.3s ease;
    }
    
    .user-creation-container input:focus,
    .user-creation-container select:focus {
        border-color: {{ $colors['GREEN'] }};
        outline: none;
        box-shadow: 0 4px 4px {{ $colors['GREEN'] }};
    }
    
    .create-user-button {
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
    
    .create-user-button:hover {
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
    
    .create-user-image.hovered {
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px {{ $colors['GREEN'] }};
    }
    
    .create-user-title.hovered {
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
    
    .alert ul {
        margin: 0;
        padding-left: 20px;
    }
    
    .alert li {
        margin-bottom: 5px;
    }
    
    .alert li:last-child {
        margin-bottom: 0;
    }
</style>