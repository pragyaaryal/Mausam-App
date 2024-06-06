<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link rel="stylesheet" href="Pragya_Aryal_2329229.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@800&display=swap" rel="stylesheet">
</head>
<body>

    <div class="backgroundimg">
        <img src="Pragya_Aryal_22329229_weathericon.png" alt="weathericon" id="weathericon">
        <h1>Mausam App</h1>
        <img src="Pragya_Aryal_22329229_default.jpg" alt="background" id="background" class="background" width="100%" height="100%">
    </div>

    <div class="cityimage">
        <img src="Pragya_Aryal_22329229_huntsville.jpg" alt="city_background" width="100%" height="100%" id="cityimage">
    </div>  

    <div class="container">

        <div class="left_side">
            
            <div class="Weekly_data">
                <button>
                    <a href="Pragya_Aryal_2329229_Connection.php"> - Weather data for past week</a>
                </button>
            </div>

            <div class="day_and_date">
                <div class="time" id="time"></div>
                <div class="date" id="date"></div>
            </div>

            <div class="temperature_and_place">
                <div class="temperature_and_icon">
                    <div class="weather_icon"></div>
                    <div class="temperature"></div>
                </div>
                <div class="place">
                    <div class="cityName_and_Country" id="cityName_and_Country"></div> 
                </div>
                <div class="weather-condition"></div>
            </div> 
        </div>

        <div class="right_side">
            <div class="search_bar">
                    <input type="text" name="value" id="search" placeholder="Search City">
                    <button type="submit"><img src="Pragya_Aryal_22329229_search.png" alt="search_bar"></button>
            </div>

            <div class="Realfeels_with_icon">
                <div class="Realfeels_icon"><img src="Pragya_Aryal_22329229_weathericon.png" alt="Realfeels_icon"></div>
                <div class="Real_feels"></div>
            </div>
            <div class="Humidity_with_icon">
                <div class="humidity_icon"><img src="Pragya_Aryal_22329229_Humidityicon.png" alt="Humidityicon"></i></div>
                <div class="Humidity"></div>
            </div>
            <div class="Windspeed_with_icon">
                <div class="Windspeed_icon"><img src="Pragya_Aryal_22329229_windicon.png" alt="windicon"></div>
                <div class="Wind-Speed"></div>
            </div>
            
            <div class="Pressure_with_icon">
                <div class="Pressure_icon"><img src="Pragya_Aryal_22329229_Pressureicon.png" alt="Pressure_icon"></div>
                <div class="Pressure"></div>
            </div> 
            <div>
                <footer> Copyright @Pragya Aryal</footer>  
            </div>
            
        </div>
        
    </div> 
    

    <script src="Pragya_Aryal_2329229.js"></script>
</body>
</html>