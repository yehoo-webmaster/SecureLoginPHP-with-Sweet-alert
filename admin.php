<?php
session_start();

// Check if the user is logged in as an admin (user_role = '1')
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== '1') {
    header("Location: login.php");
    exit;
}

// Get the admin's username if it's stored in the session
$user = isset($_SESSION['user']) ? $_SESSION['user'] : "Admin"; // Default to "Admin" if the username is not set


// Database connection setup
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ommyDb", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query to retrieve all users' data except the admin
    $sql = "SELECT * FROM users WHERE role_id = '2'"; // Assuming user_role '2' represents regular users
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $usersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Admin Panel</title>

     <!-- Include Bootstrap 4 CSS -->
     <link rel="stylesheet" href="./bootstrap_4.5.2/css/bootstrap.min.css">
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="./dataTable/css/bootstrap4.min.css">

    <!-- Include DataTables Buttons extension CSS -->
    <link rel="stylesheet" href="./dataTable/css/buttons.dataTables.min.css">

    <!-- Include DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

    <!-- Include DataTables Buttons extension JavaScript -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

    <!-- Include pdfMake for PDF export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

    <!-- Include SheetJS for Excel export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.1/xlsx.full.min.js"></script>

    <!-- Include Docxtemplater for Word export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/docxtemplater/3.19.3/docxtemplater.js"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="">Admin Panel</a>
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
    <!-- Display the admin's username -->
    <p>Welcome , <?php echo htmlspecialchars($user); ?> </p>

    <h2>All Users</h2>
    <?php if (!empty($usersData)) : ?>
        <table id="usersTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Amount</th>
                   <!-- <th>Phone</th>-->
                    <th>username</th>
                    <th>Registration Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersData as $user) : ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['first_name']; ?></td>
                        <td><?php echo $user['last_name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['amount']; ?></td>
                       <!-- <td><?php echo $user['phone']; ?></td>-->
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['registration_date']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No regular users found.</p>
    <?php endif; ?>
</div>

<!-- Include Bootstrap 4 scripts -->
<script src="./js/jquery-3.5.1.min.js"></script>
<script src="./js/popperjs_core@2.5.3_dist_umd_popper.min.js"></script>
<script src="./bootstrap_4.5.2/js/bootstrap.min.js"></script>
<!-- Include DataTables JavaScript -->
<script src="./dataTable/js/jquery.dataTables.min.js"></script>
<script src="./dataTable/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#usersTable').DataTable({
        dom: 'Bfrtip', // Add export buttons to the DOM
        buttons: [
            {
                extend: 'pdfHtml5',
                title: 'User Data', // PDF title
                text: 'Export to PDF',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6], // Include all columns in the export
                },
                customize: function(doc) {
                    // Customize the PDF document if needed
                    // For example, you can add a custom header or footer
                }
            },
            {
                extend: 'excelHtml5',
                title: 'User Data', // Excel title
                text: 'Export to Excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6], // Include all columns in the export
                },
            },
            {
                extend: 'word',
                title: 'User Data', // Word title
                text: 'Export to Word',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6], // Include all columns in the export
                },
                customize: function(doc) {
                    // Customize the Word document if needed
                    // For example, you can add a custom header or footer
                }
            },
        ],
    });
});
</script>

</body>
</html>
