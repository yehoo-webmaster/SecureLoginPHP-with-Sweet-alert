<?php
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== '2') {
    header("Location: login.php");
    exit;
}

$profile_content = "";

$pdo = new PDO("mysql:host=localhost;dbname=ommyDb", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();

if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $profile_content = "Full Name: " . $row['first_name'] . " " . $row['last_name'] . "<br>";
    $profile_content .= "User Name: " . $row['username'] . "<br>";
    $profile_content .= "Email: " . $row['email'] . "<br>";
    // Add more fields as needed
}
?>
<!-- -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile</title>
        <script src="./js/jquery-3.6.0.min.js"></script>

        <link rel="stylesheet" href="./bootstrap_4.5.2/bootstrap.min.css">
        <link rel="stylesheet" href="//add.css">
        <script src="./bootstrap_4.5.2/bootstrap.min.js"></script>
        <script src="./sweetalert2/js/cdn.jsdelivr.net_npm_sweetalert2@11"></script>
        <!-- Add these links in the head section of your HTML -->
        <link rel="stylesheet" href="./node_modules/lightbox2/src/css/lightbox.css">
        <script src="./node_modules/lightbox2/src/js/lightbox.js"></script>
        <script src="./lightbCustomize.js"></script>

        <style>
            /* Add this CSS to your HTML or a separate CSS file */

            /* The modal (background) */
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                padding: 50px;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.9);
            }

            /* Modal Content (the image) */
            .modal-content {
                /*  margin: auto;
    display: block;
    max-width: 40%;
    max-height: 70%;   */
                max-width: 70%;
            }

            /* Close button */
            .close {
                position: absolute;
                top: 15px;
                right: 35px;
                font-size: 40px;
                font-weight: bold;
                color: #fff;
                cursor: pointer;
            }
        </style>

    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Dashboard</a>
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

            <!-- Profile picture and logout button for smaller screens -->
            <div class="profile-picture-zoom order-lg-last">
                <a
                    class="nav-link"
                    href="<?php echo $row['profile']; ?>"
                    data-lightbox="profile-image"
                    data-title="User Profile">
                    <img
                        src="<?php echo $row['profile']; ?>"
                        id="profileImage"
                        alt="User Profile"
                        class="rounded-circle"
                        width="30"
                        height="30">
                </a>
            </div>
            <div class="order-lg-last">
                <a class="nav-link" href="logout.php">Logout</a>
            </div>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <span class="mr-2 d-lg-none"></span>
                        <!-- Adjust the margin as needed for spacing -->
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <nav
                    id="sidebar"
                    class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky">
                        <ul class="nav flex-column">
                            <!-- Tabs for Profile, Change Password, Upload Picture, and View Picture -->
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#profile-tab">
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link"
                                    data-toggle="tab"
                                    href="#password-tab"
                                    id="changePasswordLink">
                                    Change Password
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#photo-tab" id="uploadPictureLink">
                                    Upload Picture
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#view-tab" id="viewPictureLink">
                                    View Picture
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                    <div class="tab-content">
                        <!-- Profile tab -->
                        <div class="tab-pane show active" id="profile-tab" role="tabpanel">
                            <h2 class="mt-4">Profile</h2>
                            <?php echo $profile_content; ?>
                        </div>

                        <!-- Change Password tab -->
                        <div class="tab-pane" id="password-tab" role="tabpanel">
                            <h2 class="mt-4">Change Password</h2>
                            <div id="passwordChangeMessage"></div>
                            <form id="passwordChangeForm" class="needs-validation" novalidate="novalidate">
                                <div class="form-group">
                                    <label for="currentPassword">Current Password:</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="currentPassword"
                                        name="currentPassword">
                                    <div class="invalid-feedback">
                                        Please enter a valid password.
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="newPassword">New Password:</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword">
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm New Password:</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="confirmPassword"
                                        name="confirmPassword">
                                </div>
                                <button type="button" id="changePasswordButton" class="btn btn-primary">Change Password</button>
                            </form>
                        </div>

                        <!-- Upload Picture tab -->
                        <div class="tab-pane" id="photo-tab" role="tabpanel">
                            <h2 class="mt-4">Upload Picture</h2>
                            <div id="upload-status"></div>
                            <form id="upload-form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="profilePhoto">Choose New Profile Picture:</label>
                                    <input
                                        type="file"
                                        class="form-control-file"
                                        id="profilePhoto"
                                        name="profilePhoto"
                                        accept="image/jpeg, image/png">
                                </div>
                                <button type="submit" id="uploadButton" class="btn btn-primary">Upload</button>
                            </form>
                        </div>

                    </div>
                </main>
            </div>
        </div>
        <!-- Add this code to your HTML within the body section -->

        <audio id="successSound">
            <source src="./sound/success.mp3" type="audio/mpeg">
        </audio>

        <audio id="errorSound">
            <source src="./sound/error.mp3" type="audio/mpeg">
        </audio>

        <!-- Add a new div for displaying messages -->
        <div id="passwordChangeMessage" class="container mt-4"></div>
        <!-- Include Bootstrap JS and jQuery -->
        <script src="./js/jquery-3.5.1.min.js"></script>
        <script src="./js/popperjs_core@2.5.3_dist_umd_popper.min.js"></script>
        <script src="./bootstrap_4.5.2/js/bootstrap.min.js"></script>
        <script src="./sweetalert2/js/cdn.jsdelivr.net_npm_sweetalert2@11"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
        <script>
            $(document).ready(function () {
                // Bind click events to "Change Password," "Upload Picture," and "View Picture"
                // links

                $('#changePasswordLink').on('click', function () {
                    loadChangePasswordForm();
                });

                $('#uploadPictureLink').on('click', function () {
                    loadProfilePhotoForm();
                });

                $('#viewPictureLink').on('click', function () {
                    loadProfilePhoto();
                });
                // Handle form submission using AJAX
                $('#upload-form').on('submit', function (e) {
                    e.preventDefault();
                    var formData = new FormData(this);

                    $.ajax({
                        url: 'upload_picture.php',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            $('#upload-status').html(response);
                            $('form').trigger('reset');

                            // Update the profile picture in the top navbar
                            updateProfilePicture();

                        }
                    });

                });

                $('#uploadButton').click(function (e) {
                    var fileInput = document.getElementById('profilePhoto');
                    if (fileInput.files.length === 0) {
                        e.preventDefault();
                        showErrorAlert('Please select a file to upload');
                    } else {
                        var maxFileSize = 5 * 1024 * 1024; // 2 MB (adjust as needed)
                        var fileSize = fileInput
                            .files[0]
                            .size;
                        if (fileSize > maxFileSize) {
                            e.preventDefault();
                            showErrorAlert('File size exceeds the maximum allowed limit (5MB)');
                        } else {
                            showSuccessAlert('File uploaded successfully');
                        }
                    }
                });

                // Play error sound and show an error message using SweetAlert
                function showErrorAlert(message) {
                    var errorSound = document.getElementById('errorSound');
                    errorSound.play();
                    Swal.fire({icon: 'error', title: 'Error!', text: message});
                }

                // Play success sound and show a success message using SweetAlert
                function showSuccessAlert(message) {
                    var successSound = document.getElementById('successSound');
                    successSound.play();
                    Swal.fire({icon: 'success', title: 'Success', text: message});
                }


                // Function to update the profile picture
                function updateProfilePicture() {
                    $.ajax({
                        url: 'get_profile_picture.php', // Create a new PHP script to fetch the updated profile picture URL
                        method: 'GET',
                        success: function (imageURL) {
                            // Update the profile picture in the top navbar
                            $('#profileImage').attr('src', imageURL);
                        }
                    });
                }

                function loadProfilePhoto() {
                    $.ajax({
                        url: 'view_picture.php',
                        success: function (data) {
                            $('#view-tab')
                                .html(data)
                                .addClass('show active');
                        }
                    });
                }

                $('#changePasswordButton').on('click', function () {
                    changePassword();
                });

                function changePassword() {

                    var currentPassword = $('#currentPassword').val();
                    var newPassword = $('#newPassword').val();
                    var confirmPassword = $('#confirmPassword').val();

                    // Client-side validation

                    if (currentPassword === '' || newPassword === '' || confirmPassword === '') {
                        displayError('All fields are required.');
                    } else if (newPassword !== confirmPassword) {
                        displayError('New password and confirm password do not match.');
                    } else if (newPassword.length < 8 && confirmPassword.length < 8) {
                        displayError('password must contain 8 characters.');
                    } else {
                        $.ajax({
                            type: 'POST',
                            url: 'change_password.php',
                            data: {
                                currentPassword: currentPassword,
                                newPassword: newPassword,
                                confirmPassword: confirmPassword

                            },
                            success: function (response) {
                                // Handle the response here, which may include SweetAlert messages
                                if (response.includes('Success')) {
                                    displaySuccess(response);
                                } else {
                                    displayError(response);
                                }
                                $('form').trigger('reset');

                            }
                        });
                    }
                }

                function displaySuccess(message) {
                    Swal
                        .fire({title: 'Success', text: message, icon: 'success'})
                        .then(function () {
                            // Optionally, you can reload the page or perform other actions
                            window.location.href = "profile.php";
                        });
                }

                function displayError(message) {
                    Swal.fire({title: 'Error !', text: message, icon: 'error', timer: 5500});
                }
            });

            // JavaScript function to open the modal and display the zoomed image
            function openImageModal(imageSrc) {
                var modal = document.getElementById('imageModal');
                var img = document.getElementById('zoomedImg');
                img.src = imageSrc;
                modal.style.display = 'block';
            }

            // JavaScript function to close the modal
            function closeImageModal() {
                var modal = document.getElementById('imageModal');
                modal.style.display = 'none';
            }

            // JavaScript function to update the profile picture
            function updateProfilePicture() {
                $.ajax({
                    url: 'get_profile_picture.php',
                    method: 'GET',
                    success: function (imageURL) {
                        // Update the profile picture in the top navbar
                        $('#profileImage').attr('src', imageURL);

                        // Update the Lightbox link href attribute
                        $('[data-lightbox="profile-image"]').attr('href', imageURL);

                        // Refresh the Lightbox
                        lightbox.refresh();
                    }
                });
            }

            // Function to handle the form submission using AJAX
            $('#upload-form').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: 'upload_picture.php',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        $('#upload-status').html(response);
                        $('form').trigger('reset');

                        // Update the profile picture and refresh Lightbox
                        updateProfilePicture();
                    }
                });
            });
            lightbox.option({'resizeDuration': 200, 'wrapAround': true})

            // After successfully uploading the picture, update the profile picture in the
            // top navbar After successfully uploading the picture, update the profile
            // picture in the top navbar
            /*$.ajax({
    url: 'update_profile_picture.php', // Endpoint to update the profile picture URL
    method: 'POST',
    data: { newProfileURL: newProfileURL }, // Send the new profile picture URL
    success: function (response) {
        // Update the profile picture in the top navbar
        $('#profileImage').attr('src', newProfileURL);
    }
}); */
        </script>
    </body>
</html>
