<?php
$password = "12345678"; // Replace with your desired password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

echo "Hashed Password: " . $hashedPassword;
