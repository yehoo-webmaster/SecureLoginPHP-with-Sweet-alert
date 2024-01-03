<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Check if the user is logged in

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the form was submitted via POST

        // Retrieve user inputs from the form
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        // Validate the form data
        if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            // Ensure that none of the fields are empty
            echo "Error: All fields are required.";
        } elseif ($newPassword !== $confirmPassword) {
            // Passwords do not match; display an error message
            echo "Error: New password and confirm password do not match.";
        } else {
            // Passwords match; continue with password update

            // Check if the current password is correct (replace with your validation logic)
            $pdo = new PDO("mysql:host=localhost;dbname=ommyDb", "root", "");
            $user_id = $_SESSION['user_id'];

            $sql = "SELECT password FROM users WHERE id = :user_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && password_verify($currentPassword, $row['password'])) {
                // Current password is correct; update the user's password in the database
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $updateSql = "UPDATE users SET password = :password WHERE id = :user_id";
                $updateStmt = $pdo->prepare($updateSql);
                $updateStmt->bindParam(':password', $hashedNewPassword);
                $updateStmt->bindParam(':user_id', $user_id);

                if ($updateStmt->execute()) {
                    // Password updated successfully
                    echo "Success: Your password has been updated successfully.";
                } else {
                    // Handle database error
                    echo "Error: Error updating password in the database.";
                }
            } else {
                // Current password is incorrect; display an error message
                echo "Error: Current password is incorrect.";
            }
        }
    }
} else {
    // Redirect to the login page if the user is not logged in
    echo "Error: You are not logged in.";
}

?>
