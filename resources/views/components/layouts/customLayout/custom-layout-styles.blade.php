<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        background-color: {{ $colors['WHITE'] }};
    }
    header {
        background-color: {{ $colors['GREEN'] }}; 
        color: {{ $colors['WHITE'] }};
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
    }
    header .logo {
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }
    header .logo:hover {
        cursor: pointer;
        transform: scale(1.05);
        transition: all 0.3s ease;
    }
    header .logo img {
        height: 60px;
        width: 60px;
        border-radius: 50%;
        margin-right: 10px;
        object-fit: cover;
    }
    header .logo span {
        font-size: 1.5em;
        font-weight: bold;
        font-family: 'Montserrat', sans-serif;
    }
    header .account-info {
        display: flex;
        align-items: center;
        height: 50px;
        border-radius: 50%;
        transition: all 0.3s ease;
        padding-right: 10px;
    }
    header .account-info:hover {
        transform: scale(1.1);
        border-radius: 50%;
        transition: all 0.3s ease;
    }
    header .username {
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        color: {{ $colors['WHITE'] }};
        cursor: pointer;
        padding-right: 10px;
    }
    header .account-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
    }
    header .profile-buttons button {
        background-color: transparent;
        border: none;
        color: {{ $colors['WHITE'] }};
        font-size: 1.2em;
        cursor: pointer;
        position: relative;
    }
    header .profile-buttons button:hover {
        opacity: 0.8;
    }
    header .profile-buttons button .tooltip {
        visibility: hidden;
        background-color: {{ $colors['DARK_GRAY'] }};
        color: {{ $colors['WHITE'] }};
        text-align: center;
        border-radius: 5px;
        padding: 5px;
        position: absolute;
        z-index: 1;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: opacity 0.3s;
    }
    header .profile-buttons button:hover .tooltip {
        visibility: visible;
        opacity: 1;
    }
    footer {
        background-color: {{ $colors['LIGHT_GRAY'] }};
        color: {{ $colors['WHITE'] }};
        text-align: center;
        padding: 10px;
        margin-top: auto;
    }
    footer p {
        margin: 5px 0;
    }
    .content {
        width: 100%;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-color: {{ $colors['WHITE'] }};
    }
</style>