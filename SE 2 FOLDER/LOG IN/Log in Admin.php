<?php
// Include your database connection file
include ('../DATABASE/CONNECT.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve login credentials from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Debugging: Output the submitted username and password
    echo "Username: $username<br>";
    echo "Password: $password<br>";

    // Perform database query to check login credentials
    $query = "SELECT * FROM login WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Debugging: Output the hashed password stored in the database
        echo "Hashed Password in Database: " . $row['password'] . "<br>";

        // Verify the entered password with the hashed password
        if (password_verify($password, $row['password'])) {
            // Password is correct, proceed with login
            header("location: ../ADMIN/ADMIN.php");
            exit;
        } else {
            // Invalid password
            echo "Invalid password. Please try again.";
        }
    } else {
        // Username not found
        echo "Username not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group 5 - Responsive Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="container">
        <div class="login-wrapper">
            <h1>Sign In</h1>
            <h2>please login here</h2>
            <form method="post" class="form">
                <label for="username">username</label>
                <input type="text" name="username" id="username">
                <label for="password">password</label>
                <input type="password" name="password" id="password"> <!-- Changed input type to password -->
                <button id="loginBtn" type="submit" name="submit">Login</button>
            </form>
        </div>
    </section>
</body>
</html> 