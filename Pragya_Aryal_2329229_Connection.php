<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weekly</title>
    <style>
       *{
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        background-color: beige ;
        }

        .container{
            padding: 0px 10px 50px 0px;
            margin-left: 400px;
            margin-right: 300px;
            margin-top: 30px;
        }

        #city{
            margin-left: 100px;
            height: 30px;
           border-radius: 10px;
           color: red;
          width: 400px;
        }
        table {
            padding: 50px;
             margin-left: 400px;
             width: 50%;
             border-collapse: collapse;
        }
        th, td { 
            padding: 8px;
            text-align: center;
            border: 1px solid black;
        }
        label{
            font-size: 20px;
        }
        button{
            border: 3px solid black;
            border-radius: 2px;
            padding: 5px;
            font-size: large;
            color: black;
            text-align: center;
        }
        button:hover{
            border: 3px solid red;

        }

        a{
            text-decoration: none;
            color: black;
            border: none;
        }
        a:hover{
            color: red;
        }
        </style>
</head>
 
<button style="margin: 80px 0px 30px 750px;">
  <a href="Pragya_Aryal_2329229_WeatherApp.php">Home</a>
</button>
    <div class="container">
        <form action="" method="get" onsubmit="return validateForm();">
        <label for="city" id="type">Enter a City Name</label>
        <input type="text" id="city" name="city" placeholder="Huntsville">
        <input type="submit" value="Search" id="button">
        </form>
    </div>

<body>
<?php
// Making connection to the MySQL database
$servername = "sql306.epizy.com";
$username = "epiz_34245671";
$password = "eeDdaGvsFpxjG";
$dbname = "epiz_34245671_db_2329229";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Checking if the database is connected properly
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$city = "Kathmandu";
// If the user searches for a city, getting the weather data for that city instead
if (isset($_GET['city'])) {
    $city = $_GET['city'];
}

$apiKey = "e38260233814415b86494838230505";

$dataFetchedFromAPI = false; // Flag to indicate if data is fetched from API

// Loop through past 7 days and retrieve the weather data for each day
for ($i = 1; $i <= 7; $i++) {
    $date = date('Y-m-d', strtotime('-'.$i.' days'));

    // Check if the data already exists in the database for the city and date
    $sql = "SELECT * FROM weather_data WHERE City = '$city' AND Date_Time = '$date'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        // If data doesn't exist, retrieve the weather data from the API
        $url = "http://api.weatherapi.com/v1/history.json?key=".$apiKey."&q=".$city."&dt=".$date;
        $response = json_decode(file_get_contents($url));

        if (isset($response->forecast->forecastday)) {
            // If response is OK, retrieve the weather data from the API
            $dayData = $response->forecast->forecastday[0];
            $astro = $dayData->astro;
            $day = $dayData->day;
            $cond = $dayData->day->condition;

            // Set the flag to true as data is fetched from API
            $dataFetchedFromAPI = true;

            // Insert the weather data into the database
            $sql = "INSERT INTO weather_data (Date_Time, City, Temperature, Wind, Humidity, Description) 
                    VALUES ('$date', '$city','$day->avgtemp_c','$day->maxwind_kph','$day->avghumidity','$cond->text')";
            if (mysqli_query($conn, $sql)) {
                // echo "Weather data for ".$city." on ".$date." successfully inserted into the database.<br>";
                echo "<script>console.log('Weather data for ".$city." on ".$date." fetched from API and successfully inserted into the database.<br>');</script>";
            } else {
                // echo "Error inserting weather data: " . mysqli_error($conn)."<br>";
                echo "<script>console.log('Error inserting weather data: " . mysqli_error($conn)."<br>');</script>";
            }
        } else {
            // If there's an error fetching data from the API and it doesn't exist in the database, display an error message
            // echo "Error fetching weather data for ".$city." on ".$date." from the API.<br>";
            echo "<script>console.log('Error fetching weather data for ".$city." on ".$date." from the API.');</script>";
        }
    } else {
        // Data exists in the database, no need to fetch again
        $dataFetchedFromAPI = false;
    }
}

// Fetch the weather data from the database
$sql = "SELECT * FROM weather_data WHERE City = '$city' ORDER BY Date_Time DESC LIMIT 7";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Construct the header for the HTML table
    echo "<table>";
    echo "<tr>
    <th>Date and Time</th>
    <th>City Name</th>
    <th>Temperature (°C)</th>
    <th>Wind Speed (km/h)</th>
    <th>Humidity (%)</th>
    <th>Weather Description</th>
    </tr>";

// Display data for each row
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row["Date_Time"]."</td>";
    echo "<td>".$row["City"]."</td>";
    echo "<td>".$row["Temperature"]."</td>";
    echo "<td>".$row["Wind"]."</td>";
    echo "<td>".$row["Humidity"]."</td>";
    echo "<td>".$row["Description"]."</td>";
    echo "</tr>";
}

echo "</table>";

} else {
    // Displays error message if no data is found
    echo "No weather data available for " . $city . "<br>";
    }
    
    // Display the alert message if data is fetched from the API or database
    if ($dataFetchedFromAPI) {
    echo "<script>alert('Data fetched from the API.');</script>";
    echo "<script>console.log('Data fetched from the API.');</script>";
    } elseif (mysqli_num_rows($result) > 0) {
    echo "<script>alert('Data fetched from the database.');</script>";
    echo "<script>console.log('Data fetched from the database.');</script>";
    }
    
    // End the connection to the database
    mysqli_close($conn);
    ?>
   
 </body>
</html>