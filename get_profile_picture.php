<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Retrieve the profile picture URL from the database based on the user ID
    $pdo = new PDO("mysql:host=localhost;dbname=ommyDb", "root", "");
    $sql = "SELECT profile FROM users WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        echo $row['profile'];
    }
}
