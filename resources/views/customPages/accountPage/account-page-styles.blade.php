<style>
    .account-container {
        width: 500px;
        margin: 50px auto;
        padding: 20px;
        background-color: {{$colors['WHITE']}};
        border-radius: 10px;
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .account-image-container {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }
    
    .account-image {
        width: 180px;
        height: 180px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .account-title {
        color: {{$colors['DEFAULT_GRAY']}};
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    
    .account-container form div {
        margin-bottom: 15px;
        text-align: left;
    }
    
    .account-container label {
        display: block;
        margin-bottom: 5px;
        color: {{$colors['DARK_GRAY']}};
        font-family: 'Montserrat', sans-serif;
    }
    
    .account-container input {
        width: 100%;
        padding: 10px;
        border: 1px solid {{$colors['LIGHT_GRAY']}};
        border-radius: 5px;
        font-size: 1em;
        transition: border 0.3s ease, box-shadow 0.3s ease;
    }
    
    .account-container input:focus {
        border-color: {{$colors['GREEN']}};
        outline: none;
        box-shadow: 0 4px 4px {{$colors['GREEN']}};
    }
    
    .account-button {
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
        margin-top: 10px;
    }
    
    .account-button:hover {
        background-color: {{$colors['GREEN_HOVER']}};
    }
    
    .home-button {
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
        margin-top: 10px;
    }
    
    .home-button:hover {
        background-color: {{$colors['GREEN_HOVER']}};
    }
    
    .account-image.hovered {
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px {{ $colors['GREEN'] }};
    }
    
    .account-title.hovered {
        transition: all 0.3s ease;
        color: {{$colors['GREEN']}};
    }
    
    .alert-success {
        padding: 10px;
        margin-top: 15px;
        background-color: rgba(46, 204, 113, 0.2);
        color: {{$colors['GREEN']}};
        border-radius: 5px;
        border: 1px solid {{$colors['GREEN']}};
        font-family: 'Montserrat', sans-serif;
    }
</style>
