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
    .login-container:hover h2 {
        color: {{$colors['GREEN']}};
    }
    .login-container h2 {
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
    .login-container button {
        width: 100%;
        padding: 10px;
        background-color: {{$colors['GREEN']}};
        color: {{$colors['WHITE']}};
        border: none;
        border-radius: 5px;
        font-size: 1em;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }
    .login-container button:hover {
        background-color: {{$colors['GREEN_HOVER']}};
    }
    .error-message {
        color: {{$colors['RED']}};
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        margin-bottom: 15px;
    }
</style>