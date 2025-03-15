<style>
    .account-container {
        text-align: center;
        background-color: {{$colors['WHITE']}};
        padding: 40px;
        border-radius: 10px;
        width: 500px;
        margin: 50px auto;
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
        transition: all 0.3s ease;
    }

    .account-header {
        margin-bottom: 30px;
    }

    .account-title {
        color: {{$colors['DEFAULT_GRAY']}};
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        font-size: 1.5em;
    }

    .account-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-group {
        text-align: left;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: {{$colors['DEFAULT_GRAY']}};
        font-family: 'Montserrat', sans-serif;
        font-weight: 600;
    }

    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid {{$colors['LIGHT_GRAY']}};
        border-radius: 5px;
        font-family: 'Roboto', sans-serif;
        transition: all 0.3s ease;
    }

    .form-group input:focus {
        border-color: {{$colors['GREEN']}};
        outline: none;
        box-shadow: 0 0 8px rgba(46, 204, 113, 0.3);
    }

    .btn-save {
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
        margin-top: 15px;
    }

    .btn-save:hover {
        background-color: {{$colors['GREEN_HOVER']}};
        transform: translateY(-2px);
    }

    .alert-success {
        padding: 15px;
        background-color: rgba(46, 204, 113, 0.2);
        color: {{$colors['GREEN']}};
        border-radius: 5px;
        margin-top: 20px;
        border: 2px solid {{$colors['GREEN']}};
        font-family: 'Montserrat', sans-serif;
    }
</style>