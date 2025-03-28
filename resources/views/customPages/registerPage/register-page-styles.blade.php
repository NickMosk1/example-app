<style>
    .user-creation-container {
        width: 500px;
        margin: 50px auto;
        padding: 20px;
        background-color: {{$colors['WHITE']}};
        border-radius: 10px;
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
        text-align: center;
        transition: all 0.3s ease;
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
        color: {{$colors['DEFAULT_GRAY']}};
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
        color: {{$colors['DARK_GRAY']}};
        font-family: 'Montserrat', sans-serif;
    }
    
    .user-creation-container input {
        width: 100%;
        padding: 10px;
        border: 1px solid {{$colors['LIGHT_GRAY']}};
        border-radius: 5px;
        font-size: 1em;
        transition: border 0.3s ease, box-shadow 0.3s ease;
    }
    
    .user-creation-container input:focus {
        border-color: {{$colors['GREEN']}};
        outline: none;
        box-shadow: 0 4px 4px {{$colors['GREEN']}};
    }
    
    .create-user-button {
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
    
    .create-user-button:hover {
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
    
    .create-user-image.hovered {
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px {{ $colors['GREEN'] }};
    }
    
    .create-user-title.hovered {
        transition: all 0.3s ease;
        color: {{$colors['GREEN']}};
    }
    
    .login-link {
        margin-top: 20px;
        font-family: 'Montserrat', sans-serif;
        color: {{$colors['DARK_GRAY']}};
    }
    
    .login-link a {
        color: {{$colors['GREEN']}};
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .login-link a:hover {
        color: {{$colors['GREEN_HOVER']}};
        text-decoration: underline;
    }
    
    .error {
        color: {{$colors['RED']}};
        font-family: 'Montserrat', sans-serif;
        margin: 15px 0;
        padding: 10px;
        background-color: rgba(244, 67, 54, 0.1);
        border-radius: 5px;
        border-left: 3px solid {{$colors['RED']}};
    }
    
    .success {
        color: {{$colors['GREEN']}};
        font-family: 'Montserrat', sans-serif;
        margin: 15px 0;
        padding: 10px;
        background-color: rgba(76, 175, 80, 0.1);
        border-radius: 5px;
        border-left: 3px solid {{$colors['GREEN']}};
    }
</style>