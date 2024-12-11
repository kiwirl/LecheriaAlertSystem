<?php
    // Define constants
    $BASE_URL = "http://api.openweathermap.org/data/2.5/weather?";
    $API_KEY = "cd6ea3830a487d7be38b9fd2f77048e0";

    // Input City (can replace with dynamic input)
    $CITY = "Calamba"; // Change this to the city you want or take it from a form input

    // Function to convert Kelvin to Celsius
    function kelvin_to_celsius($kelvin) {
        return $kelvin - 273.15;
    }

    // Build the API URL
    $url = $BASE_URL . "appid=" . $API_KEY . "&q=" . urlencode($CITY);

    // Call the API and get the response
    $response = file_get_contents($url);
    $responseData = json_decode($response, true);

    // Check if the response is valid
    if ($responseData && $responseData['cod'] == 200) {
        // Get current temperature data
        $temp_kelvin = $responseData['main']['temp'];
        $temp_celsius = kelvin_to_celsius($temp_kelvin);

        // Get high and low temperature for the day
        $temp_max_kelvin = $responseData['main']['temp_max'];
        $temp_min_kelvin = $responseData['main']['temp_min'];
        $temp_max_celsius = kelvin_to_celsius($temp_max_kelvin);
        $temp_min_celsius = kelvin_to_celsius($temp_min_kelvin);

        // Get "feels like" temperature
        $feels_like_kelvin = $responseData['main']['feels_like'];
        $feels_like_celsius = kelvin_to_celsius($feels_like_kelvin);

        // Other weather details
        $wind_speed = $responseData['wind']['speed'];
        $humidity = $responseData['main']['humidity'];
        $description = $responseData['weather'][0]['description'];
        
        // Sunrise and sunset times (in UTC, convert to local)
        $sunrise_time = $responseData['sys']['sunrise'] + $responseData['timezone'];
        $sunset_time = $responseData['sys']['sunset'] + $responseData['timezone'];

        // Convert timestamps to readable time format
        $sunrise_time = date("H:i:s", $sunrise_time);
        $sunset_time = date("H:i:s", $sunset_time);

        // Output the weather information with Celsius only
        echo "Weather Forecast for {$CITY}:<br>";
        echo "Current Temperature: " . number_format($temp_celsius, 2) . "°C<br>";
        echo "Feels Like: " . number_format($feels_like_celsius, 2) . "°C<br>";
        echo "High Temperature Today: " . number_format($temp_max_celsius, 2) . "°C<br>";
        echo "Low Temperature Today: " . number_format($temp_min_celsius, 2) . "°C<br>";
        echo "Humidity: {$humidity}%<br>";
        echo "Wind Speed: {$wind_speed} m/s<br>";
        echo "Weather Description: {$description}<br>";
        echo "Sunrise: {$sunrise_time} (local time)<br>";
        echo "Sunset: {$sunset_time} (local time)<br>";
    } else {
        echo "Error: Unable to retrieve weather data for {$CITY}. Please check the city name or try again later.<br>";
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Info</title>

    <style>
        svg {
        display: block;
        margin-left: auto;
        margin-right: auto;
        }

        svg path {
        fill: #c7ffc1;
        stroke: #eee;
        stroke-width: .25;
        }
        svg path:hover {
        fill: #8ee3ff;
        transition: 0.6s;
        cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Get Weather Information</h1>
    <form method="GET" action="API.php">
        <label for="city">Enter City:</label>
        <input type="text" id="city" name="city" required>
        <button type="submit">Get Weather</button>
    </form>

    <h2>Weather Information:</h2>
    <?php
    if (isset($_GET['city'])) {
        // Get city from form input
        $CITY = $_GET['city'];

        // Include your PHP weather fetching code here (the code provided above)
        // Or you can place the PHP code in a separate file, e.g., weather.php and include it here
    }
    ?>
    <h5><?php echo "Temperature in {$CITY}: " . number_format($temp_celsius, 2) . "°C"; ?></h5>
    <h5><?php echo "Temperature in {$CITY} feels like: " . number_format($feels_like_celsius, 2) . "°C"; ?></h5>
    <h5><?php echo "Humidity in {$CITY}: {$humidity}%"; ?></h5>
    <h5><?php echo "Wind Speed in {$CITY}: {$wind_speed}m/s"; ?></h5>
    <h5><?php echo "General Weather in {$CITY}: {$description}"; ?></h5>
    <h5><?php echo "Sun rises in {$CITY}: {$sunrise_time} local time."; ?></h5>
    <h5><?php echo "Sun sets in {$CITY}: {$sunset_time} local time."; ?></h5>

    <h5><?php echo "Today's weather in {$CITY}: {$description}."; ?></h5>

    <h5 id="myUpdate">Waiting for data...</h5> <!-- This will be updated periodically -->

    <?php include('MAP.php') ?>
</body>
</html>
