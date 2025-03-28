<style>
    .container {
        max-width: 1300px;
        width: 100%;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .authorization-quote {
        color: {{$colors['DEFAULT_GRAY']}};
        font-family: 'Montserrat', sans-serif;
        font-size: 1.5em;
        margin-top: 20px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }
    .authorization-quote:hover {
        color: {{$colors['GREEN']}};
    }
    .header-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 20px 0 20px 0;
    }
    .btn {
        font-weight: bold;
        font-family: 'Montserrat', sans-serif;
        padding: 15px 30px;
        color: {{$colors['WHITE']}};
        background-color: {{$colors['GREEN']}};
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 16px;
    }
    .btn:hover {
        background-color: {{$colors['GREEN_HOVER']}};
    }
    .about-company {
        color: {{$colors['DEFAULT_GRAY']}};
        font-family: 'Montserrat', sans-serif;
        font-size: 1.5em;
        margin-top: 35px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    .about-company:hover {
        color: {{$colors['GREEN']}};
    }
    .cards {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
        width: 100%;
        max-width: 1200px;
        margin-top: 40px;
    }
    .card {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        padding: 10px;
        background-color: {{$colors['WHITE']}};
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
    }
    .card:hover .card-title {
        color: {{$colors['GREEN']}};
    }
    .card img {
        border-radius: 10px;
        height: 100px;
        width: 100px;
        object-fit: cover;
    }
    .card-content {
        padding: 8px 20px 8px 20px;
    }
    .card-title {
        color: {{$colors['DEFAULT_GRAY']}};
        font-weight: bold;
        font-family: 'Montserrat', sans-serif;
        font-size: 1.2em;
        margin-bottom: 10px;
    }
    .card-text {
        font-family: 'Montserrat', sans-serif;
        font-size: 1em;
        color: {{$colors['DARK_GRAY']}};
    }
    .user-roles-container {
        margin-top: 20px;
        text-align: center;
        padding: 15px;
        background-color: {{ $colors['WHITE'] }};
        border-radius: 10px;
        width: 80%;
        max-width: 600px;
        box-shadow: 0 2px 4px {{ $colors['LIGHT_GRAY'] }};
        transition: all 0.3s ease;
        cursor: default;
    }
    .user-roles-container:hover {
        box-shadow: 0 4px 12px {{ $colors['GREEN'] }};
    }
    .user-roles-title {
        color: {{ $colors['DEFAULT_GRAY'] }};
        font-family: 'Montserrat', sans-serif;
        font-size: 1.2em;
        margin-bottom: 10px;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    .user-roles-container:hover .user-roles-title {
        color: {{ $colors['GREEN'] }};
    }
    .user-roles-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }
    .role-badge {
        padding: 8px 15px;
        background-color: {{ $colors['GREEN'] }};
        color: {{ $colors['WHITE'] }};
        border-radius: 20px;
        font-family: 'Montserrat', sans-serif;
        font-size: 0.9em;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: default;
    }
    .role-badge:hover {
        transform: translateY(-2px);
        background-color: {{ $colors['GREEN_HOVER'] }};
        box-shadow: 0 2px 4px {{ $colors['LIGHT_GRAY'] }};
        cursor: default;
    }
</style>