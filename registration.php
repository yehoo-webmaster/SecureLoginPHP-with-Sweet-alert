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

$suggestionMessage = ""; // Initialize the suggestion message variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize inputs
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $amount = $_POST['amount'];
    $phone = $_POST['phone'];

    $username = $phone;

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
// Set the success message
$successMessage = "Registration successful! Your username is: " . $phone;

         // Create a JavaScript popup to display the username
         echo "<script>alert('Your username is: $phone');</script>";

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
        <script src="./js/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="./bootstrap_4.5.2/bootstrap.min.css">
        <script src="./bootstrap_4.5.2/bootstrap.min.js"></script>
        <link rel="stylesheet" href="./fontawesome-free-5.15.4-web/css/all.min.css">
        <script src="./sweetalert2/js/cdn.jsdelivr.net_npm_sweetalert2@11"></script>

        <style>
            body {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                /* This ensures vertical centering */
            }

            #register-btn {
                width: 100%;

            }

            .navbar {
                background: #569E7F;
                padding: 12px;
                box-shadow: inset 0 -3em 3em rgba(0, 0, 0, 0.1), 0 0 0 2px rgb(255, 255, 255), 0.3em 0.3em 1em rgba(0, 0, 0, 0.3);
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

            /* Adjust padding and margins for smaller screens */
            @media (max-width: 480px) {
                .card {
                    margin-top: 0;
                }

                .form-group {
                    margin-bottom: 15px;
                }

                .carousel-item img {
                    width: 100%;
                    padding-top: 56.25%;
                    /* 16:9 aspect ratio (9 / 16 * 100%) */
                    position: relative;
                    overflow: hidden;
                    max-height: 400px;
                    /* Set a maximum height as needed */
                }

                .card {
                    margin-top: 15px;
                    /* Adjust the height as needed */
                }

                .card-body {
                    overflow-y: auto;
                    /* Add a vertical scrollbar if content exceeds card height */
                }
            }

            /* Define the shake animation */
            @keyframes shake {
                0%,
                60% {
                    transform: translateX(10);
                }
                10%,
                50%,
                70%,
                90% {
                    transform: translateX(-3px);
                }
                20%,
                60%,
                80%,
                85% {
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
        <div class="container">
            <!-- Navigation Bar -->
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
                <a class="navbar-brand" href="index.php">
                    <i class="fas fa-hand-point-right text-danger shake mr-2"></i>
                    <!-- Green finger icon -->
                    Microfinance Company
                </a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-white" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="registration.php">Register</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container d-flex justify-content-center align-items-center mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="text-center">Register new Client/User</h2>
                            </div>
                            <div class="card-body">
                            <div id="register-status"></div>

                                <form method="POST" action="registration.php" id="registrationForm">

                                    <!-- Form fields go here -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <label for="firstname">Firstname:</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="firstname"
                                                    name="firstname"
                                                    placeholder="eg: john">
                                                <div class="invalid-feedback">Firstname cannot be empty.</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <label for="phone">Phone Number:</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="phone"
                                                    name="phone"
                                                    pattern="[0-9]{1,10}"
                                                    placeholder="eg: 0712345678">
                                                <p class="text-white font-weight-bold bg-success">Note! your phone number will be your username</p>
                                                <div class="invalid-feedback">Phone number is required and must be valid 10-digits phone number</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <label for="lastname">Lastname:</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="lastname"
                                                    name="lastname"
                                                    placeholder="eg: mwakatobe">
                                                <div class="invalid-feedback">Lastname cannot be empty.</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <label for="email">Email:</label>
                                                <input
                                                    type="email"
                                                    class="form-control"
                                                    id="email"
                                                    name="email"
                                                    placeholder="abc@gmail.com">
                                                <div class="invalid-feedback">Invalid email address.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <label for="amount">Amount in Tsh:</label>
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="amount"
                                                    name="amount"
                                                    placeholder="eg: 25000">
                                                <div class="invalid-feedback">Amount cannot be empty.</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                                <label for="password">Password:</label>
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    id="password"
                                                    name="password"
                                                    placeholder="eg. Abcdefgh8">
                                                <div class="invalid-feedback">Password must be at least 8 characters.</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <button type="submit" id="register-btn" class="btn btn-primary p-3 clicked">Register</button>
                                    </div>
                                </form>

                                <!-- login link for new users -->
                                <p class="mt-4 text-center">Already registered?
                                    <a href="login.php">Login Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include Bootstrap 4 scripts -->
        <script src="./js/jquery-3.5.1.min.js"></script>
        <script src="./js/popperjs_core@2.5.3_dist_umd_popper.min.js"></script>
        <script src="./bootstrap_4.5.2/js/bootstrap.min.js"></script>
        <script href="./sweetalert2/js/SweetAlert.js"></script>

        <script>
            $(document).ready(function () {
                //jquery validate phone number
                jQuery('input[name="phone"]').keyup(function () {
                    var phoneNumber = jQuery(this).val();
                    var allow = phoneNumber.replace(/[^\d{10}$ _]/, '');
                    jQuery(this).val(allow);
                    if (!allow) {
                        Swal.fire(
                            {title: 'Error !', text: "Only Numbers Allowed, Eg. 0712...8", icon: 'error', timer: 5500}
                        );

                    }
                });
                //prevent
                $("input").on("keypress", function (e) {
                    if (e.which === 32 && !this.value.length) 
                        e.preventDefault();
                    }
                );
                //jquery validate Amount
                jQuery('input[name="amount"]').keyup(function () {
                    var phoneNumber = jQuery(this).val();
                    var allow = phoneNumber.replace(/[^\d{10}$ _]/, '');
                    jQuery(this).val(allow);
                    if (!allow) {
                        Swal.fire(
                            {title: 'Error !', text: "Only Numbers Allowed, Eg. 25000", icon: 'error', timer: 5500}
                        );

                    }
                });
                //prevent
                $("input").on("keypress", function (e) {
                    if (e.which === 32 && !this.value.length) 
                        e.preventDefault();
                    }
                );


            });

            document.addEventListener("DOMContentLoaded", function () {
                const registrationForm = document.getElementById("registrationForm");
                const emailField = document.getElementById("email");
                const passwordField = document.getElementById("password");
                const firstnameField = document.getElementById("firstname");
                const phoneField = document.getElementById("phone");
                const registerBtn = document.getElementById("register-btn");

                // Function to display the suggestion message
                function displaySuggestionMessage(message) {
                    const suggestionMessageElement = document.getElementById("suggestionMessage");
                    suggestionMessageElement.textContent = message;
                    suggestionMessageElement.style.display = "block";
                }

                registrationForm.addEventListener("submit", function (event) {
                    event.preventDefault();

                    // Perform custom form validation here
                    const firstname = document
                        .getElementById("firstname")
                        .value
                        .trim();
                    const lastname = document
                        .getElementById("lastname")
                        .value
                        .trim();
                    const email = emailField
                        .value
                        .trim();
                    const phone = document
                        .getElementById("phone")
                        .value
                        .trim();
                    const amount = document
                        .getElementById("amount")
                        .value
                        .trim();
                    const password = passwordField
                        .value
                        .trim();

                    // Check if any required field is empty
                    let isValid = true;

                    if (firstname === "") {
                        document
                            .getElementById("firstname")
                            .classList
                            .add("is-invalid");
                        isValid = false;
                    } else {
                        document
                            .getElementById("firstname")
                            .classList
                            .remove("is-invalid");
                        document
                            .getElementById("firstname")
                            .classList
                            .add("is-valid");
                    }

                    if (lastname === "") {
                        document
                            .getElementById("lastname")
                            .classList
                            .add("is-invalid");
                        isValid = false;
                    } else {
                        document
                            .getElementById("lastname")
                            .classList
                            .remove("is-invalid");
                        document
                            .getElementById("lastname")
                            .classList
                            .add("is-valid");
                    }

                    if (!validateEmail(email)) {
                        document
                            .getElementById("email")
                            .classList
                            .remove("is-valid");
                        document
                            .getElementById("email")
                            .classList
                            .add("is-invalid");
                        isValid = false;
                    } else {
                        document
                            .getElementById("email")
                            .classList
                            .add("is-valid");
                        document
                            .getElementById("email")
                            .classList
                            .remove("is-invalid");
                    }

                    if (phone === "") {
                        document
                            .getElementById("phone")
                            .classList
                            .add("is-invalid");
                        isValid = false;
                    } else {
                        document
                            .getElementById("phone")
                            .classList
                            .remove("is-invalid");
                        document
                            .getElementById("phone")
                            .classList
                            .add("is-valid");
                    }

                    if (amount === "") {
                        document
                            .getElementById("amount")
                            .classList
                            .add("is-invalid");
                        isValid = false;
                    } else {
                        document
                            .getElementById("amount")
                            .classList
                            .remove("is-invalid");
                        document
                            .getElementById("amount")
                            .classList
                            .add("is-valid");
                    }

                    if (password.length < 8) {
                        document
                            .getElementById("password")
                            .classList
                            .remove("is-valid");
                        document
                            .getElementById("password")
                            .classList
                            .add("is-invalid");
                        isValid = false;
                    } else {
                        document
                            .getElementById("password")
                            .classList
                            .add("is-valid");
                        document
                            .getElementById("password")
                            .classList
                            .remove("is-invalid");
                    }

                    // Function to validate email address
                    function validateEmail(email) {
                        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        return re.test(email);
                    }

                    // Add an input event listener for all fields except password to update as the
                    // user types
                    const formFields = document.querySelectorAll(
                        ".form-control:not(#password):not(#email)"
                    );
                    formFields.forEach(function (field) {
                        field.addEventListener("input", function () {
                            const value = field
                                .value
                                .trim();

                            if (value !== "") {
                                field
                                    .classList
                                    .add("is-valid");
                                field
                                    .classList
                                    .remove("is-invalid");
                            } else {
                                field
                                    .classList
                                    .remove("is-valid");
                                field
                                    .classList
                                    .add("is-invalid");
                            }
                        });
                    });

                    // Add an input event listener for the password field to update when it reaches
                    // 8 characters
                    passwordField.addEventListener("input", function () {
                        const password = passwordField
                            .value
                            .trim();

                        if (password.length >= 8) {
                            passwordField
                                .classList
                                .add("is-valid");
                            passwordField
                                .classList
                                .remove("is-invalid");
                        } else {
                            passwordField
                                .classList
                                .remove("is-valid");
                            passwordField
                                .classList
                                .add("is-invalid");
                        }
                    });

                    phoneField.addEventListener("input", function () {
                        const phoneNumber = phoneField
                            .value
                            .trim();
                        const isValidPhoneNumber = /^\d{10}$/.test(phoneNumber);

                        if (!isValidPhoneNumber) {
                            phoneField
                                .classList
                                .remove("is-valid");
                            phoneField
                                .classList
                                .add("is-invalid");
                        } else {
                            phoneField
                                .classList
                                .remove("is-invalid");
                            phoneField
                                .classList
                                .add("is-valid");
                        }
                        /* Remove any non-digit characters from the input
                        const cleanedPhoneNumber = isValidPhoneNumber.replace(/\D/g, "");

                        // Update the input field with the cleaned phone number
                        phoneField.value = cleanedPhoneNumber; */
                    });

                    // Add an input event listener for the email field to update when it's a valid
                    // email
                    emailField.addEventListener("input", function () {
                        const email = emailField
                            .value
                            .trim();

                        if (validateEmail(email)) {
                            emailField
                                .classList
                                .add("is-valid");
                            emailField
                                .classList
                                .remove("is-invalid");
                        } else {
                            emailField
                                .classList
                                .remove("is-valid");
                            emailField
                                .classList
                                .add("is-invalid");
                        }
                    });

                    // If all validations pass, you can submit the form
                    if (isValid) {
                        /* Disable the Register button and change its color
                        registerBtn.disabled = true;
                        registerBtn.style.backgroundColor = "cadetblue";
                        registerBtn.textContent = "Registering..."; */

                        Swal.fire(
                            {title: 'Congratulation', text: "Your Successfuly Registered", icon: 'success', timer: 5500}
                        );  
                     //chech error here in submiting feedback
                        registrationForm.submit();
                        $('#register-status').html(response);
                        window.location.href = "login.php";
                          }
                });

            });
        </script>

    </body>

</html>
