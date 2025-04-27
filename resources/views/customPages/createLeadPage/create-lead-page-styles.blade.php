<style>
    .create-lead-container {
        width: 500px;
        margin: 50px auto;
        padding: 20px;
        background-color: {{$colors['WHITE']}};
        border-radius: 10px;
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
        text-align: center;
    }
    .create-lead-image-container {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }
    .create-lead-image {
        width: 180px;
        height: 180px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .create-lead-title {
        color: {{$colors['DARK_GRAY']}};
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    .create-lead-container form div {
        margin-bottom: 15px;
        text-align: left;
    }
    .create-lead-container label {
        display: block;
        margin-bottom: 5px;
        color: {{$colors['DARK_GRAY']}};
        font-family: 'Montserrat', sans-serif;
    }
    .create-lead-container input, 
    .create-lead-container select {
        width: 100%;
        padding: 10px;
        border: 1px solid {{$colors['LIGHT_GRAY']}};
        border-radius: 5px;
        font-size: 1em;
        transition: all 0.3s ease;
    }
    .create-lead-container input:focus, 
    .create-lead-container select:focus {
        border-color: {{$colors['GREEN']}};
        outline: none;
        box-shadow: 0 0 0 2px {{$colors['LIGHT_GREEN']}};
    }
    
    .source-form {
        margin: 20px 0;
        padding: 15px;
        background-color: {{$colors['WHITE']}};
        border: 1px solid {{$colors['LIGHT_GRAY']}};
        border-radius: 8px;
        animation: fadeIn 0.3s ease;
    }
    .source-form h3 {
        color: {{$colors['DARK_GRAY']}};
        font-family: 'Montserrat', sans-serif;
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 1.1em;
    }
    
    .price-range-hint {
        display: block;
        color: {{$colors['DARK_GRAY']}};
        font-size: 0.8em;
        margin-top: 5px;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .create-lead-button,
    .home-button {
        width: 100%;
        padding: 12px 20px;
        background-color: {{$colors['GREEN']}};
        color: {{$colors['WHITE']}};
        font-weight: bold;
        font-family: 'Montserrat', sans-serif;
        border: none;
        border-radius: 5px;
        font-size: 1em;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }
    .create-lead-button:hover,
    .home-button:hover {
        background-color: {{$colors['GREEN_HOVER']}};
        transform: translateY(-2px);
    }
    
    .create-lead-image.hovered {
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px {{$colors['GREEN']}};
        transform: scale(1.05);
    }
    .create-lead-title.hovered {
        transition: all 0.3s ease;
        color: {{$colors['GREEN']}};
    }
    
    .success {
        color: {{$colors['GREEN']}};
        background-color: {{$colors['LIGHT_GREEN']}};
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        border-left: 3px solid {{$colors['GREEN']}};
    }
    .error {
        color: {{$colors['RED']}};
        background-color: {{$colors['WHITE']}};
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        border-left: 3px solid {{$colors['RED']}};
    }
    .error-message {
        color: {{$colors['RED']}};
        font-size: 0.8em;
        display: block;
        margin-top: 5px;
    }
</style>