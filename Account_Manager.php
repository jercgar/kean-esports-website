<?php

// Include database connection
include 'dbtab.php';

// Process form submission to create a new account
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form submission is for creating a new worker
    if (isset($_POST['create_worker'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $student_id = $_POST['student_id'];
        $role = $_POST['role']; 
        
        // Insert the worker into the database
        $sql = "INSERT INTO workers (first_name, last_name, email, password, student_id, role) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $first_name, $last_name, $email, $password, $student_id, $role);
        $stmt->execute();
        $stmt->close();
    }
    // Check if the form submission is for editing a worker 
    if (isset($_POST['edit_worker'])) {
        $user_id = $_POST['edit_user_id']; // Change this line
        $first_name = $_POST['edit_first_name']; // Update field names
        $last_name = $_POST['edit_last_name']; // Update field names
        $email = $_POST['edit_email']; // Update field names
        $password = $_POST['edit_password']; // Update field names
        $student_id = $_POST['edit_student_id']; // Update field names
        $role = $_POST['edit_role']; // Update field names
    
        // Update the worker in the database
        $sql = "UPDATE workers SET first_name=?, last_name=?, email=?, password=?, student_id=?, role=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $first_name, $last_name, $email, $password, $student_id, $role, $user_id);
        $stmt->execute();
        $stmt->close();
    }
    

    // Check if the form submission is for deleting a worker
    if (isset($_POST['delete_worker'])) {
        $id = $_POST['user_id'];

        // Delete the worker from the database
        $sql = "DELETE FROM workers WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect to refresh the page and display the updated table
    header("Location: Account_Manager.php");
    exit();
}

// Retrieve workers data from the database
$sql = "SELECT * FROM workers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Manager - Kean University eSports Arena</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Additional CSS for header */
        header {
            background-color: #007bff; /* Bootstrap primary color */
            color: #fff; /* White text */
            padding: 20px; /* Add padding to the header */
            text-align: center; /* Center align the text */
        }

        /* Additional CSS for vertical line */
        .vertical-line {
            border-left: 1px solid #ccc;
            height: 30px; /* Adjust height as needed */
            margin: 0 10px; /* Adjust margin as needed */
        }
    </style>
</head>
<body>
<header>
        <h1>Account Manager</h1>
    </header>
    <nav class="navbar navbar-expand-lg" style="background-color: #154360;">
        <div class="container-fluid">
            <a class="navbar-brand"><img src="logos/KeanEsportsLogo_2.png" alt="Logo" height="100"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="index.php">Home</a>
                    </li>
                    <?php echo $loginOption; ?>
                    <li class="nav-item">
                    <a class="btn btn-outline-light" href="availability.php">PC Availability</a>
                    </li>
                    <?php echo $dailyLogOption; ?>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="OperationHours.php">Hours</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="Download_Request_Form.php">Download Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="Rules.php">Rules</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="FAQ.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="Esports.html">Esports</a>
                    </li>
                    <?php echo $logoutOption; ?>
                </ul>
                <ul class="navbar-nav">
                    <!-- New list item for social media icons -->
                    <li class="nav-item">
                        <a class="nav-link" href="https://twitter.com/Kean_Esports" target="_blank"><img src="logos/xlogo.png" alt="Twitter Logo" class="social-icon" width="30" height="30"></a>
                    </li>
                    <!-- Vertical line between icons -->
                    <li class="nav-item vertical-line"></li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.twitch.tv/kean_esports" target="_blank"><img src="logos/twitchlogo.png" alt="Twitch Logo" class="social-icon" width="30" height="30"></a>
                    </li>
                    <!-- Vertical line between icons -->
                    <li class="nav-item vertical-line"></li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://www.instagram.com/kean_esports" target="_blank"><img src="logos/instagram.png" alt="Instagram Logo" class="social-icon" width="30" height="30"></a>
                    </li>
                    <!-- Vertical line between icons -->
                    <li class="nav-item vertical-line"></li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://discord.gg/MqYR638K" target="_blank"><img src="logos/DiscordLogo.png" alt="Discord Logo" class="social-icon" width="30" height="30"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <br>
        <button class="btn btn-outline-dark mb-3" data-bs-toggle="modal" data-bs-target="#createAccountModal">Create Account</button>

        <!-- Display workers table -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Student ID</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['student_id']; ?></td>
                        <td><?php echo $row['role']; ?></td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-sm btn-outline-warning edit-button" data-bs-toggle="modal" data-bs-target="#editAccountModal<?php echo $row['user_id']; ?>">Edit</button>
                            <!-- Delete Button -->
                            <form action="Account_Manager.php" method="post" class="d-inline">
                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                <button type="submit" name="delete_worker" class="btn btn-sm btn-outline-danger"onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Create Account Modal -->
    <div class="modal fade" id="createAccountModal" tabindex="-1" aria-labelledby="createAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAccountModalLabel">Create Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="Account_Manager.php" method="post">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="student_id" name="student_id" required>
                        </div>
                        <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="">Select Role</option>
                            <option value="worker">Worker</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="create_worker" class="btn btn-primary">Create Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Account Modals -->
    <?php
    // Reset result set pointer
    $result->data_seek(0);

    // Loop through workers to generate edit modals
    while ($row = $result->fetch_assoc()) {
        // Modal ID
        $modal_id = "editAccountModal" . $row['user_id'];
    ?>

    
        <div class="modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" aria-labelledby="<?php echo $modal_id; ?>Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAccountModalLabel">Edit Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="Account_Manager.php" method="post">
            <div class="modal-body">
                <input type="hidden" name="edit_user_id" value="<?php echo $row['user_id']; ?>">
            <div class="mb-3">
                <label for="edit_first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="edit_first_name" name="edit_first_name" value="<?php echo $row['first_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="edit_last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="edit_last_name" name="edit_last_name" value="<?php echo $row['last_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="edit_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="edit_email" name="edit_email" value="<?php echo $row['email']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="edit_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="edit_password" name="edit_password" value="<?php echo $row['password']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="edit_student_id" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="edit_student_id" name="edit_student_id" value="<?php echo $row['student_id']; ?>" required>
            </div>
                    <div class="mb-3">
                        <label for="edit_role" class="form-label">Role</label>
                        <select class="form-select" id="edit_role" name="edit_role" required>
                            <option value="worker" <?php if ($row['role'] === 'worker') echo 'selected'; ?>>Worker</option>
                            <option value="admin" <?php if ($row['role'] === 'admin') echo 'selected'; ?>>Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="edit_worker" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
<br><br><br><br><br><br><br><br><br><br><br><br><br>
<footer class="footer">
        <div class="container text-center">
            <!-- Footer Links -->
            <p>Connect to the rest of Kean:</p>
            <a href="https://kean.edu" target="_blank">Kean University Website</a>
            <span class="footer-divider">|</span>
            <a href="https://keanathletics.com" target="_blank">Kean Athletics</a>
            <span class="footer-divider">|</span>
            <a href="https://webreg.kean.edu/WebAdvisor/WebAdvisor?TYPE=M&PID=CORE-WBMAIN&TOKENIDX=1241765240" target="_blank">KeanWISE</a>
            <span class="footer-divider">|</span>
            <a href="https://selfservice.kean.edu/Student/" target="_blank">Student Planning</a>
        </div>
    </footer>
</html>