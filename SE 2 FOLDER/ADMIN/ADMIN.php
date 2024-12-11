<?php
    include ('../DATABASE/connect.php');

    $reminder_id = "";
    $reminder_title = "";
    $reminder_content = "";

    // Handle form submission
    if(isset($_POST['submit'])) {
        // Retrieve the selected type from the form
        $reminder_id = $_POST['reminder_id'];
        $reminder_title = $_POST['reminderTitle'];
        $reminder_content = $_POST['reminderContent'];

        $qry = "INSERT INTO reminder (reminder_title, reminder_content) VALUES ('$reminder_title', '$reminder_content')";
        $result = $conn->query($qry);
        header('location: ADMIN.php');
        exit;
    }
?>

<?php
    // Define constants
    $BASE_URL = "http://api.openweathermap.org/data/2.5/weather?";
    $API_KEY = "cd6ea3830a487d7be38b9fd2f77048e0";

    // Input City (can replace with dynamic input)
    $CITY = "Calamba"; // Change this to the city you want or take it from a form input

    // Function to convert Kelvin to Celsius and Fahrenheit
    function kelvin_to_celsius_fahrenheit($kelvin) {
        $celsius = $kelvin - 273.15;
        $fahrenheit = $celsius * (9/5) + 32;
        return [$celsius, $fahrenheit];
    }

    // Build the API URL
    $url = $BASE_URL . "appid=" . $API_KEY . "&q=" . urlencode($CITY);

    // Call the API and get the response
    $response = file_get_contents($url);
    $responseData = json_decode($response, true);

    // Check if the response is valid
    if ($responseData && $responseData['cod'] == 200) {
        // Get the weather description
        $description = $responseData['weather'][0]['description'];
    } else {
        echo "Error: Unable to retrieve weather data for {$CITY}. Please check the city name or try again later.\n";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecheria Weather Alert System</title>

    <link rel="stylesheet" href="../ASSETS/ADMIN.css">
    
</head>
<body>
    <header>
        <img src="../HOME PAGE/Lecheria Logo.png" alt="Digital Barangay Logo">
        <div>
            <h1>Barangay Lecheria Admin</h1>
            <p>A Community Weather Alert System</p>
        </div>
    </header>

    <nav>
        <a href="../ADMIN/ADMIN.php">ADMIN</a>
        <a href="adminBQRT.php">BQRT</a>
        <a href="adminOFFICIALS.php">BRGY OFFICIALS</a>
        <a href="../HOME PAGE/Home Page.php">LOG OUT</a>
    </nav>

    <div class="content-container">
        <div class="right-section">
            <div class="map">
                <h2>Alert System</h2>
                <?php
                    if (isset($_GET['city'])) {
                        // Get city from form input
                        $CITY = $_GET['city'];

                        // Include your PHP weather fetching code here (the code provided above)
                        // Or you can place the PHP code in a separate file, e.g., weather.php and include it here
                    }
                ?>

                <h5><?php echo "Today's weather in {$CITY}: {$description}."; ?></h5>
                <!-- <h5 id="myUpdate">Waiting for data...</h5>  This will be updated periodically -->

                <div class="svg-container">
                    <?xml version="1.0" encoding="UTF-8" standalone="no"?>
                    <!-- Created with Inkscape (http://www.inkscape.org/) -->
                    <?php include('../MAP.php') ?>                
                    <div class="controls">
                        <h2>Kanluran</h2>
                        <button style="background-color: #9eff99; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('kanluran', '#9eff99', '#66cc66', 2)">Good Weather</button>
                        <button style="background-color: #efff6f; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('kanluran', '#efff6f', '#cccc33', 2)">Light Rain</button>
                        <button style="background-color: #ffab40; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('kanluran', '#ffab40', '#cc6600', 2)">Moderate Rain</button>
                        <button style="background-color: #ff2e2e; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('kanluran', '#ff2e2e', '#990000', 2)">Heavy Rain</button>

                        <h2>Ronggot</h2>
                        <button style="background-color: #9eff99; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('barera', '#9eff99', '#66cc66', 2)">Good Weather</button>
                        <button style="background-color: #efff6f; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('barera', '#efff6f', '#cccc33', 2)">Light Rain</button>
                        <button style="background-color: #ffab40; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('barera', '#ffab40', '#cc6600', 2)">Moderate Rain</button>
                        <button style="background-color: #ff2e2e; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('barera', '#ff2e2e', '#990000', 2)">Heavy Rain</button>

                        <h2>Barera</h2>
                        <button style="background-color: #9eff99; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('ronggot', '#9eff99', '#66cc66', 2)">Good Weather</button>
                        <button style="background-color: #efff6f; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('ronggot', '#efff6f', '#cccc33', 2)">Light Rain</button>
                        <button style="background-color: #ffab40; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('ronggot', '#ffab40', '#cc6600', 2)">Moderate Rain</button>
                        <button style="background-color: #ff2e2e; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('ronggot', '#ff2e2e', '#990000', 2)">Heavy Rain</button>

                        <h2>FJ</h2>
                        <button style="background-color: #9eff99; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('fj', '#9eff99', '#66cc66', 2)">Good Weather</button>
                        <button style="background-color: #efff6f; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('fj', '#efff6f', '#cccc33', 2)">Light Rain</button>
                        <button style="background-color: #ffab40; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('fj', '#ffab40', '#cc6600', 2)">Moderate Rain</button>
                        <button style="background-color: #ff2e2e; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('fj', '#ff2e2e', '#990000', 2)">Heavy Rain</button>

                        <h2>Ramada</h2>
                        <button style="background-color: #9eff99; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('ramada', '#9eff99', '#66cc66', 2)">Good Weather</button>
                        <button style="background-color: #efff6f; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('ramada', '#efff6f', '#cccc33', 2)">Light Rain</button>
                        <button style="background-color: #ffab40; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('ramada', '#ffab40', '#cc6600', 2)">Moderate Rain</button>
                        <button style="background-color: #ff2e2e; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('ramada', '#ff2e2e', '#990000', 2)">Heavy Rain</button>

                        <h2>Lote</h2>
                        <button style="background-color: #9eff99; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('lote', '#9eff99', '#66cc66', 2)">Good Weather</button>
                        <button style="background-color: #efff6f; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('lote', '#efff6f', '#cccc33', 2)">Light Rain</button>
                        <button style="background-color: #ffab40; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('lote', '#ffab40', '#cc6600', 2)">Moderate Rain</button>
                        <button style="background-color: #ff2e2e; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('lote', '#ff2e2e', '#990000', 2)">Heavy Rain</button>

                        <h2>Watawat & FJ2</h2>
                        <button style="background-color: #9eff99; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('watawat', '#9eff99', '#66cc66', 2)">Good Weather</button>
                        <button style="background-color: #efff6f; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('watawat', '#efff6f', '#cccc33', 2)">Light Rain</button>
                        <button style="background-color: #ffab40; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('watawat', '#ffab40', '#cc6600', 2)">Moderate Rain</button>
                        <button style="background-color: #ff2e2e; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('watawat', '#ff2e2e', '#990000', 2)">Heavy Rain</button>

                        <h2>Silangan</h2>
                        <button style="background-color: #9eff99; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('silangan', '#9eff99', '#66cc66', 2)">Good Weather</button>
                        <button style="background-color: #efff6f; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('silangan', '#efff6f', '#cccc33', 2)">Light Rain</button>
                        <button style="background-color: #ffab40; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('silangan', '#ffab40', '#cc6600', 2)">Moderate Rain</button>
                        <button style="background-color: #ff2e2e; color: #000000; padding: 10px 20px; border-radius: 5px; cursor: pointer;" onclick="setColor('silangan', '#ff2e2e', '#990000', 2)">Heavy Rain</button>
                    </div>        
                </div>
            </div>

            <div class="left-section">
            <form method="post">
            <input type="hidden" name="reminder_id" value="<?php echo $row['reminder_id']; ?>" class="form-control">
            <div class="reminders">
                <h2>Create Reminder</h2>
                <div class="form-group">
                    <label for="reminderTitle">Title</label>
                    <input type="text" id="reminderTitle" name="reminderTitle" placeholder="Enter title">
                </div>
                <div class="form-group">
                    <label for="reminderContent">Content</label>
                    <textarea id="reminderContent" name="reminderContent" rows="4" placeholder="Enter content"></textarea>
                </div>
                <button type="submit" name="submit" onclick="addReminder()">Publish</button>
                <h2>Reminders</h2>
                <div id="remindersList">
                </div>
            </div>
            </form>
        </div>
    </div>

    

    <script>
        
        function addReminder() {
        const title = document.getElementById("reminderTitle").value;
        const content = document.getElementById("reminderContent").value;

        if (!title || !content) {
            alert("Please fill in all fields.");
            return;
        }

        const reminder = { title, content };

        // Fetch or initialize reminders in local storage
        let reminders = localStorage.getItem("reminders");
        reminders = reminders ? JSON.parse(reminders) : [];
        reminders.push(reminder);

        // Save updated reminders back to local storage
        localStorage.setItem("reminders", JSON.stringify(reminders));

        // Clear form fields
        document.getElementById("reminderTitle").value = "";
        document.getElementById("reminderContent").value = "";

        // Update the admin view
        displayReminders();

        alert("Reminder added! It will appear on the homepage.");
    }

    function removeReminder(index) {
        let reminders = localStorage.getItem("reminders");
        reminders = reminders ? JSON.parse(reminders) : [];
        reminders.splice(index, 1);

        // Save updated reminders
        localStorage.setItem("reminders", JSON.stringify(reminders));
        displayReminders();
    }

    function displayReminders() {
        const remindersList = document.getElementById("remindersList");
        remindersList.innerHTML = ""; // Clear previous reminders

        // Fetch reminders
        let reminders = localStorage.getItem("reminders");
        reminders = reminders ? JSON.parse(reminders) : [];

        // Display each reminder
        reminders.forEach((reminder, index) => {
            const reminderElement = document.createElement("div");
            reminderElement.classList.add("reminder-item");

            const titleElement = document.createElement("h3");
            titleElement.textContent = reminder.title;

            const contentElement = document.createElement("p");
            contentElement.textContent = reminder.content;

            const deleteButton = document.createElement("button");
            deleteButton.textContent = "Delete";
            deleteButton.onclick = () => removeReminder(index);

            reminderElement.appendChild(titleElement);
            reminderElement.appendChild(contentElement);
            reminderElement.appendChild(deleteButton);
            remindersList.appendChild(reminderElement);
        });
    }

    // Load reminders on admin page load
    window.onload = displayReminders;


    function changeFillColor(pathId, defaultFillColor, defaultStrokeColor = '#000', defaultStrokeWidth = 2) {
    // Prompt the user to enter a new color for the path fill
    const newFillColor = prompt("Enter a new fill color for this path (e.g., #ff5733):", defaultFillColor);

    // If a valid color is entered, apply the new fill and stroke settings to the path element
    if (newFillColor) {
        const pathElement = document.getElementById(pathId);

        if (pathElement) {
            pathElement.setAttribute("fill", newFillColor);
            pathElement.setAttribute("stroke", defaultStrokeColor);
            pathElement.setAttribute("stroke-width", defaultStrokeWidth);
        }
    }
}



    </script>



</body>
</html>