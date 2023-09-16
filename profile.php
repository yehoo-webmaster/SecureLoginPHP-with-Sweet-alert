<?php
session_start();
// Check if the user is not logged in
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== '2') {
    header("Location: login.php");
    exit;
}

// Retrieve user data
$user_id = $_SESSION['user_id'];

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ommyDb", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Fix the typo here
    // Query the database to fetch data based on user id
    $sql = "SELECT * FROM users WHERE  id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        // Display user profile info
        $full_name = $user['first_name'] . ' ' . $user['last_name'];
        $registration_date = $user['registration_date'];
        $amount = $user['amount'];
        $profile_content = "
            <h1>User profile</h1>
            <p><strong>Full Name:</strong> $full_name</p>
            <p><strong>Registration Date:</strong> $registration_date</p>
            <p><strong>Amount in Tz shilling:</strong> $amount</p>
        ";
    } else {
        // Handle if the user doesn't exist
        $profile_content = "User Not Found";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <!-- Include Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link btn-danger text-white" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
<div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <marquee><h2 class="text-center">welcome <?php echo $full_name ?> </h2></marquee>
                </div>
                <div class="card-body">
                    <?php echo $profile_content; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap 4 scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
