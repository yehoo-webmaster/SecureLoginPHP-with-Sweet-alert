<?php
session_start();
// Initialize the status message
$statusMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES["profilePhoto"]["name"])) {
        // Handle file upload logic here
        $user_id = $_SESSION['user_id'];
        $uploadDir = 'images/';

        $profilePhotoName = $user_id . '_' . time() . '_' . basename($_FILES['profilePhoto']['name']);
        $uploadFile = $uploadDir . $profilePhotoName;

        $allowedTypes = ['image/jpeg', 'image/png'];
        if (in_array($_FILES['profilePhoto']['type'], $allowedTypes)) {
            if (move_uploaded_file($_FILES['profilePhoto']['tmp_name'], $uploadFile)) {
                $pdo = new PDO("mysql:host=localhost;dbname=ommyDb", "root", "");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Construct the URL of the uploaded image
                $profilePhotoURL = 'images/' . $profilePhotoName;

                // Update the user's profile picture URL in the 'users' table
                $sql = "UPDATE users SET profile = :profilePhotoURL WHERE id = :user_id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':profilePhotoURL', $profilePhotoURL);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->execute();

                // Display a success message using SweetAlert
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: "Profile picture uploaded successfully",
                        showConfirmButton: false,
                        timer: 2000
                    });
                 </script>';
                exit;
            } else {
                // Display an error message using SweetAlert
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error !",
                        text: "Error uploading profile picture",
                        showConfirmButton: false,
                        timer: 2500
                    });
                </script>';
                exit;
            }
        } else {
            // Display an error message using SweetAlert
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error !",
                    text: "Invalid file type. Allowed types: image/jpeg, image/png",
                    showConfirmButton: true,
                    timer: 2300
                });
            </script>';
            exit;
        }
    } else {
        // Display an error message using SweetAlert
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error !",
                text:"Please Click Choose File",
                showConfirmButton: true,
                timer: 5500
            });
        </script>';
        exit;
    }
}
?>
