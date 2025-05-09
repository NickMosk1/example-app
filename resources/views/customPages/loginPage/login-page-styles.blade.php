<style>
    .login-container {
        width: 500px;
        margin: 50px auto;
        padding: 20px;
        background-color: {{$colors['WHITE']}};
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
        transition: all 0.3s ease;
    }
    .login-image-container {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }
    .login-image {
        width: 180px;
        height: 180px;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .login-title {
        color: {{$colors['DEFAULT_GRAY']}};
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    .login-title {
        color: {{$colors['DEFAULT_GRAY']}};
        font-weight: bold;
        font-family: 'Montserrat', sans-serif;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    .login-container form div {
        margin-bottom: 15px;
        text-align: left;
    }
    .login-container label {
        display: block;
        margin-bottom: 5px;
        color: {{$colors['DARK_GRAY']}};
        font-family: 'Montserrat', sans-serif;
    }
    .login-container input {
        width: 100%;
        padding: 10px;
        border: 1px solid {{$colors['LIGHT_GRAY']}};
        border-radius: 5px;
        font-size: 1em;
        transition: all 0.3s ease;
    }
    .login-container input:focus {
        border-color: {{$colors['GREEN']}};
        outline: none;
        box-shadow: 0 4px 4px {{$colors['GREEN']}};
    }
    .login-button {
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
    .login-button:hover {
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
    .login-image.hovered {
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px {{ $colors['GREEN'] }};
    }
    .login-title.hovered {
        color: {{$colors['GREEN']}};
    }
    .error-message {
        color: {{$colors['RED']}};
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        margin-bottom: 15px;
    }
</style>