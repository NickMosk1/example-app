<style>
    .user-creation-container {
        width: 500px;
        margin: 50px auto;
        padding: 20px;
        background-color: {{$colors['WHITE']}};
        border-radius: 10px;
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
        text-align: center;
    }
    .user-creation-container .success {
        color: {{$colors['GREEN']}};
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        margin-bottom: 15px;
    }
    .user-creation-container .error {
        color: {{$colors['RED']}};
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        margin-bottom: 15px;
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
        transition: all 0.3s ease;
    }
    .user-creation-container input:focus {
        border-color: {{$colors['GREEN']}};
        outline: none;
        box-shadow: 0 4px 4px {{$colors['GREEN']}};
    }
    .user-creation-container button {
        width: 100%;
        padding: 10px 20px;
        background-color: {{$colors['GREEN']}};
        color: {{$colors['WHITE']}};
        border: none;
        border-radius: 5px;
        font-size: 1em;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }
    .user-creation-container button:hover {
        background-color: {{$colors['GREEN_HOVER']}};
    }
</style>