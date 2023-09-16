<?php
session_start();

if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] === '1') {
        header("Location: admin.php");
    } elseif ($_SESSION['user_role'] === '2') {
        header("Location: profile.php");
    }
    exit;
}

$suggestionMessage = ""; // Initialize the suggestion message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize inputs
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $amount = $_POST['amount'];
    $phone = $_POST['phone'];

    $username =   $phone;

    // Hash password for security
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Set the role_id (assuming '2' for regular users)
    $role_id = 2;

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=ommyDb", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert user data into the 'users' table
        $sql = "INSERT INTO users (first_name, last_name, email, phone, username, password, amount, registration_date, role_id)
                VALUES (:first_name, :last_name, :email, :phone, :username, :password, :amount, NOW(), :role_id)";

        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':first_name', $firstname);
        $stmt->bindParam(':last_name', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username); // Add username parameter
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':phone', $phone);
        
        $stmt->bindParam(':role_id', $role_id);

        // Execute the prepared statement
        $stmt->execute();

        // Set the suggestion message
        $suggestionMessage = "Registration successful! Your username suggestion is: " . $username;

        // Redirect to login after successful registration
        header("Location: login.php");
        exit;
    } catch (PDOException $e) {
        // Handle any database error
        echo "Registration failed: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <!-- Include Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2 class="text-center">Register new Client/User</h2>
                </div>
                <div class="card-body">
            <form method="POST" action="registration.php" id="registrationForm">

         
                <!-- Form fields go here -->
<div class="row">
    <div class="col-md-6">
        <div class="form-floating mb-3">
    <label for="firstname">Firstname:</label>
    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="eg: john">
    <div class="invalid-feedback">Firstname cannot be empty.</div>
                </div>
              </div>


              <div class="col-md-6">
                <div class="form-floating mb-3">
               <label for="phone">Phone Number:</label>
                    <input type="text" class="form-control" id="phone" name="phone"  placeholder="eg: 0712345678">
                    <div class="invalid-feedback">Phone number is required and must be valid.</div>
                </div>
</div>
 

<div class="col-md-6">
                <div class="form-floating mb-3">
                <label for="lastname">Lastname:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="eg: mwakatobe">
                <div class="invalid-feedback">Lastname cannot be empty.</div>
            </div>
</div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="abc@gmail.com">
                <div class="invalid-feedback">Invalid email address.</div>
            </div>
</div> 
</div>

<div class="row">
<div class="col-md-6">
        <div class="form-floating mb-3">  
           <label for="amount">Amount:</label>
                <input type="text" class="form-control" id="amount" name="amount" placeholder="eg: Tsh: 25000">
                <div class="invalid-feedback">Amount cannot be empty.</div>
            </div>
</div>

<div class="col-md-6">
        <div class="form-floating mb-3">
              <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
                <div class="invalid-feedback">Password must be at least 8 characters.</div>
            </div>
</div>
</div>


<div class="form-floating mb-3">
                <button type="submit" id="register-btn" class="btn btn-primary">Register</button>
      </div> 
            </form>
            
                <!-- Register link for new users -->
        <p class="mt-4 text-center">Already registerd? <a href="login.php">Login Here</a></p>
        </div>
    </div>
</div>
</div>
</div>


    <!-- Include Bootstrap 4 scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        const registrationForm = document.getElementById("registrationForm");
        const emailField = document.getElementById("email");
        const passwordField = document.getElementById("password");
        const firstnameField = document.getElementById("firstname");
        const phoneField= document.getElementById("phone");


// Function to display the suggestion message
function displaySuggestionMessage(message) {
    const suggestionMessageElement = document.getElementById("suggestionMessage");
    suggestionMessageElement.textContent = message;
    suggestionMessageElement.style.display = "block";
}

        registrationForm.addEventListener("submit", function (event) {
            event.preventDefault();

            // Perform custom form validation here
            const firstname = document.getElementById("firstname").value.trim();
            const lastname = document.getElementById("lastname").value.trim();
            const email = emailField.value.trim();
            const phone = document.getElementById("phone").value.trim();
            const amount = document.getElementById("amount").value.trim();
            const password = passwordField.value.trim();

            // Check if any required field is empty
            let isValid = true;

            if (firstname === "") {
                document.getElementById("firstname").classList.add("is-invalid");
                isValid = false;
            } else {
                document.getElementById("firstname").classList.remove("is-invalid");
                document.getElementById("firstname").classList.add("is-valid");
            }

            if (lastname === "") {
                document.getElementById("lastname").classList.add("is-invalid");
                isValid = false;
            } else {
                document.getElementById("lastname").classList.remove("is-invalid");
                document.getElementById("lastname").classList.add("is-valid");
            }

            if (!validateEmail(email)) {
                document.getElementById("email").classList.remove("is-valid");
                document.getElementById("email").classList.add("is-invalid");
                isValid = false;
            } else {
                document.getElementById("email").classList.add("is-valid");
                document.getElementById("email").classList.remove("is-invalid");
            }

            if (phone === "") {
                document.getElementById("phone").classList.add("is-invalid");
                isValid = false;
            } else {
                document.getElementById("phone").classList.remove("is-invalid");
                document.getElementById("phone").classList.add("is-valid");
            }

            if (amount === "") {
                document.getElementById("amount").classList.add("is-invalid");
                isValid = false;
            } else {
                document.getElementById("amount").classList.remove("is-invalid");
                document.getElementById("amount").classList.add("is-valid");
            }

            if (password.length < 8) {
                document.getElementById("password").classList.remove("is-valid");
                document.getElementById("password").classList.add("is-invalid");
                isValid = false;
            } else {
                document.getElementById("password").classList.add("is-valid");
                document.getElementById("password").classList.remove("is-invalid");
            }

            // If all validations pass, you can submit the form
            if (isValid) {
                registrationForm.submit();
            }
        });

        // Function to validate email address
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // Add an input event listener for all fields except password to update as the user types
        const formFields = document.querySelectorAll(".form-control:not(#password):not(#email)");
        formFields.forEach(function (field) {
            field.addEventListener("input", function () {
                const value = field.value.trim();

                if (value !== "") {
                    field.classList.add("is-valid");
                    field.classList.remove("is-invalid");
                } else {
                    field.classList.remove("is-valid");
                    field.classList.add("is-invalid");
                }
            });
        });

        // Add an input event listener for the password field to update when it reaches 8 characters
        passwordField.addEventListener("input", function () {
            const password = passwordField.value.trim();

            if (password.length >= 8) {
                passwordField.classList.add("is-valid");
                passwordField.classList.remove("is-invalid");
            } else {
                passwordField.classList.remove("is-valid");
                passwordField.classList.add("is-invalid");
            }
        });

        // Add an input event listener for the email field to update when it's a valid email
        emailField.addEventListener("input", function () {
            const email = emailField.value.trim();

            if (validateEmail(email)) {
                emailField.classList.add("is-valid");
                emailField.classList.remove("is-invalid");
            } else {
                emailField.classList.remove("is-valid");
                emailField.classList.add("is-invalid");
            }
        });
    });
</script>

 



</body>

</html>
