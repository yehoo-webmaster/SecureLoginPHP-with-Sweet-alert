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
<html lang="en">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <!-- Include Bootstrap CSS && jquery && fontawesome -->
        <script src="./js/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="./bootstrap_4.5.2/bootstrap.min.css">
        <script src="./bootstrap_4.5.2/bootstrap.min.js"></script>
        <link rel="stylesheet" href="./fontawesome-free-5.15.4-web/css/all.min.css">
        <!-- Include SweetAlert2 CSS -->
        <link rel="stylesheet" href="./sweetalert2/css/sweetalert2.min.css">
        <link rel="stylesheet" href="./sweetalert2/js/SweetAlert.js">
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

            .container {
                max-width: 400px;
            }

            @media (min-width: 992px) {
                .container {
                    max-width: 600px;
                    /* Increase the maximum width for larger screens */
                }
            }

            .navbar {
                background: #569E7F;
                padding: 12px;
                box-shadow: inset 0 -3em 3em rgba(0, 0, 0, 0.1), 0 0 0 2px rgb(255, 255, 255), 0.3em 0.3em 1em rgba(0, 0, 0, 0.3);
            }

            /* Custom CSS to change login button background color when clicked */
            #login-btn.clicked {
                background-color: tomato;
                outline-color: green;
            }

            /* Default outline color (greenyellow) */
            #login-btn {
                outline-color: greenyellow;
            }

            /* Outline color when form is not valid (red) */
            #login-btn.error {
                outline-color: red;
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

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="text-center">Company Name or Logo</h2>
                        </div>
                        <div class="card-body">
                            <?php if (isset($error_message)): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                            <?php endif; ?>
                            <form
                                method="POST"
                                action="login.php"
                                id="loginForm"
                                class="needs-validation"
                                novalidate="novalidate">
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="username"
                                        name="username"
                                        placeholder="Enter your phone number eg: 0712345678"
                                        value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                                        required="required">
                                    <div class="invalid-feedback">
                                        Please enter a valid 10-digits phone number e.g=> 0712345678
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="password"
                                        name="password"
                                        required="required">
                                    <div class="invalid-feedback">
                                        Please enter a valid password.
                                    </div>
                                </div>
                                <button type="submit" id="login-btn" class="btn btn-primary mt-2 w-100 p-3">Login</button>
                            </form>
                            <!-- Register link for new users -->
                            <p class="mt-4 text-center">Don't have an account?
                                <a href="registration.php">Register Here</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include Bootstrap JS and jQuery -->
        <script src="./js/jquery-3.5.1.min.js"></script>
        <script src="./js/popperjs_core@2.5.3_dist_umd_popper.min.js"></script>
        <script src="./bootstrap_4.5.2/js/bootstrap.min.js"></script>
        <script src="./sweetalert2/js/cdn.jsdelivr.net_npm_sweetalert2@11"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>

        <script>
            $(document).ready(function () {
                //jquery validate phone number
                jQuery('input[name="username"]').keyup(function () {
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
            });
            document.addEventListener("DOMContentLoaded", function () {
                const usernameInput = document.getElementById("username");
                const passwordInput = document.getElementById("password");
                const loginBtn = document.getElementById("login-btn"); // Get the login button

                // Add a click event listener to the login button
                loginBtn.addEventListener("click", function () {
                    // Apply the custom class when the login button is clicked
                    loginBtn
                        .classList
                        .add("clicked");
                });

                usernameInput.addEventListener("input", function () {
                    const inputValue = usernameInput
                        .value
                        .trim();
                    const isValidPhoneNumber = /^\d{10}$/.test(inputValue);

                    if (!isValidPhoneNumber) {
                        usernameInput
                            .classList
                            .remove("is-valid");
                        usernameInput
                            .classList
                            .add("is-invalid");
                    } else {
                        usernameInput
                            .classList
                            .remove("is-invalid");
                        usernameInput
                            .classList
                            .add("is-valid");
                    }
                });

                passwordInput.addEventListener("input", function () {
                    const passwordValue = passwordInput
                        .value
                        .trim();

                    if (passwordValue === "") {
                        passwordInput
                            .classList
                            .remove("is-valid");
                        passwordInput
                            .classList
                            .remove("is-invalid");
                    } else if (passwordValue.length >= 8) {
                        passwordInput
                            .classList
                            .remove("is-invalid");
                        passwordInput
                            .classList
                            .add("is-valid");
                    } else {
                        passwordInput
                            .classList
                            .remove("is-valid");
                        passwordInput
                            .classList
                            .add("is-invalid");
                    }
                });

                const loginForm = document.getElementById("loginForm");

                loginForm.addEventListener("submit", function (event) {
                    event.preventDefault();

                    // Retrieve and sanitize input
                    const username = usernameInput
                        .value
                        .trim();
                    const password = passwordInput
                        .value
                        .trim();

                    // Check validation here (e.g., check if fields are filled correctly)
                    if (username === "") {
                        usernameInput
                            .classList
                            .remove("is-valid");
                        usernameInput
                            .classList
                            .add("is-invalid");
                    } else {
                        usernameInput
                            .classList
                            .remove("is-invalid");
                        usernameInput
                            .classList
                            .add("is-valid");
                    }

                    const passwordValue = passwordInput
                        .value
                        .trim();
                    if (passwordValue === "") {
                        passwordInput
                            .classList
                            .remove("is-valid");
                        passwordInput
                            .classList
                            .add("is-invalid");

                        loginBtn
                            .classList
                            .add("error");

                    } else if (passwordValue.length >= 8) {
                        passwordInput
                            .classList
                            .remove("is-invalid");
                        passwordInput
                            .classList
                            .add("is-valid");
                        loginForm.submit();
                    } else {
                        passwordInput
                            .classList
                            .remove("is-valid");
                        passwordInput
                            .classList
                            .add("is-invalid");

                        // Apply the 'error' class to the login button when the form is not valid
                        loginBtn
                            .classList
                            .add("error");
                    }
                });
            });
        </script>
    </body>

</html>
