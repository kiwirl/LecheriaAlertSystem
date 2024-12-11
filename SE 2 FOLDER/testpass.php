<?php
$password = 'securepassword'; // The password you want to test
$hashedPassword = '$2y$10$RrDummWYjtWWO8fWRDiaxuSzRaOJNy9N4GkAOttwF8ngkFgGLpz8.'; // The hash stored in the database

if (password_verify($password, $hashedPassword)) {
    echo "Password is correct!";
} else {
    echo "Password is incorrect.";
}
?>