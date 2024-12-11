<?php
// Include database connection
include('../DATABASE/CONNECT.php');

// Fetch all users
$query = "SELECT admin_id, password FROM login";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$updated_count = 0;

while ($row = $result->fetch_assoc()) {
    $admin_id = $row['admin_id'];
    $plain_password = $row['password'];

    // Debugging: Output the password before hashing
    echo "Plain Password: $plain_password<br>";

    // Hash only if the password is not already hashed
    if (password_get_info($plain_password)['algo'] === 0) {
        // Hash the password
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

        // Debugging: Output the hashed password
        echo "Hashed Password: $hashed_password<br>";

        // Update database with the hashed password
        $update_query = "UPDATE login SET password = ? WHERE admin_id = ?";
        $stmt = $conn->prepare($update_query);
        if ($stmt) {
            $stmt->bind_param("si", $hashed_password, $admin_id);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $updated_count++;
            }
        }
    }
}

echo "$updated_count password(s) have been hashed and updated.";
?>
