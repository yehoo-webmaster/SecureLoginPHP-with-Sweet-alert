<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=ommyDb", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query to retrieve user data by username
        $sql = "SELECT id, username, password, role_id FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
        // Password is correct, set user role and id in session
    $_SESSION['user_role'] = $user['role_id'];
    $_SESSION['user_id'] = $user['id']; // Add this line to set user_id

            if ($user['role_id'] === '1') {
                header("Location: admin.php");
                exit;
            } elseif ($user['role_id'] === '2') {
                header("Location: profile.php");
                exit;
            }
        } else {
            // Invalid login credentials - Display a Bootstrap validation error message
            $error_message = "Invalid username or password.";
        }
    } catch (PDOException $e) {
        // Handle any database error
        echo "Login failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <!-- Include Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

 <style>
        
        body {
        background-image: url('./images/real.jpg'); /* Replace 'background.jpg' with your image file path */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed; /* Keeps the background image fixed while scrolling */
    }
#register-btn {
    width: 100%;
  }

#login-btn{
    width: 100%;
  }

        .card {
            margin-top: 15px;
        }

        /* Adjust padding and margins for smaller screens */
        @media (max-width: 576px) {
            .card {
                margin-top: 0;
            }

            .form-group {
                margin-bottom: 15px;
            }
        }
/* Define the shake animation */
@keyframes shake {
    0%, 60% {
        transform: translateX(10);
    }
    10%, 50%, 70%, 90% {
        transform: translateX(-3px);
    }
    20%, 60%, 80%, 85% {
        transform: translateX(5px);
    }
}

/* Apply the shake animation to the .shake class */
.shake {
    animation: shake 0.5s;
    animation-iteration-count: infinite;
}

    </style>

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
        <i class="fas fa-hand-point-right text-danger shake mr-2"></i> <!-- Green finger icon -->
            Microfinance Company
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="registration.php">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="text-center">company Name or Logo </h2>
                </div>
                <div class="card-body">
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <form method="POST" action="login.php" id="loginForm" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your number eg: 0712345678" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
                        <div class="valid-feedback">
                            <i class="fas fa-check text-success"></i>
                        </div>
                        <div class="invalid-feedback">
                            Please enter a valid username.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="valid-feedback">
                            <i class="fas fa-check text-success"></i>
                        </div>
                        <div class="invalid-feedback">
                            Please enter a valid password.
                        </div>
                    </div>

                    <button type="submit" id="login-btn" class="btn btn-primary mt-2">Login</button>
                </form>
                <!-- Register link for new users -->
        <p class="mt-4 text-center">Don't have an account? <a href="registration.php">Register Here</a></p>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap 4, SweetAlert2, and Font Awesome scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const usernameInput = document.getElementById("username");
            const passwordInput = document.getElementById("password");

            usernameInput.addEventListener("input", function () {
                if (usernameInput.value.trim() === "") {
                    usernameInput.classList.remove("is-valid");
                    usernameInput.classList.remove("is-invalid");
                } else {
                    usernameInput.classList.remove("is-invalid");
                    usernameInput.classList.add("is-valid");
                }
            });

            passwordInput.addEventListener("input", function () {
                const passwordValue = passwordInput.value.trim();

                if (passwordValue === "") {
                    passwordInput.classList.remove("is-valid");
                    passwordInput.classList.remove("is-invalid");
                } else if (passwordValue.length >= 8) {
                    passwordInput.classList.remove("is-invalid");
                    passwordInput.classList.add("is-valid");
                } else {
                    passwordInput.classList.remove("is-valid");
                    passwordInput.classList.add("is-invalid");
                }
            });

            const loginForm = document.getElementById("loginForm");

            loginForm.addEventListener("submit", function (event) {
                event.preventDefault();

                // Retrieve and sanitize input
                const username = usernameInput.value.trim();
                const password = passwordInput.value.trim();

                // Check validation here (e.g., check if fields are filled correctly)
                if (username === "") {
                    usernameInput.classList.remove("is-valid");
                    usernameInput.classList.add("is-invalid");
                } else {
                    usernameInput.classList.remove("is-invalid");
                    usernameInput.classList.add("is-valid");
                }

                const passwordValue = passwordInput.value.trim();
                if (passwordValue === "") {
                    passwordInput.classList.remove("is-valid");
                    passwordInput.classList.add("is-invalid");
                } else if (passwordValue.length >= 8) {
                    passwordInput.classList.remove("is-invalid");
                    passwordInput.classList.add("is-valid");
                    loginForm.submit();
                } else {
                    passwordInput.classList.remove("is-valid");
                    passwordInput.classList.add("is-invalid");
                }
            });
        });
    </script>
</body>

</html>
