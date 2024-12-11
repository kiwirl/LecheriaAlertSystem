<?php
$password = 'chinee';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo $hashedPassword;
?>