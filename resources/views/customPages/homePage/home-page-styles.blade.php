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
        box-shadow: 0 4px 4px {{$colors['LIGHT_GRAY']}};
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
</style>