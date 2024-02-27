<?php
// Place your session handling code here to ensure users are logged in.
session_start();

// Database connection parameters
$servername = "localhost";
$username = "justin";
$password = "justin";
$dbname = "esports";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['username'])) {
    $dailyLogOption = '<li><a href="DailyLog.php">Daily Log</a></li>';
    $logoutOption = '<li><a href="logout.php">Logout</a></li>';
    $loginOption = '';
} else {
    $dailyLogOption = '';
    $logoutOption = '';
    $loginOption = '<li><a href="login.php">Login</a></li>';
}

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database (use your database credentials)
    $conn = new mysqli("localhost", "justin", "justin", "esports");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // This part handles new record insertion
    // Sanitize user inputs (you can add more validation)
    $first_name = mysqli_real_escape_string($conn, $_POST["first_name"]);
    $last_name = mysqli_real_escape_string($conn, $_POST["last_name"]);
    $computer_choice = mysqli_real_escape_string($conn, $_POST["computer_choice"]);
    $student_id = mysqli_real_escape_string($conn, $_POST["student_id"]);

    // Validate computer choice range (1-23)
    if ($computer_choice < 1 || $computer_choice > 23) {
        $error_message = "Computer choice must be between 1 and 23.";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO daily_log (first_name, last_name, computer_choice, student_id) VALUES ('$first_name', '$last_name', $computer_choice, $student_id)";

        if ($conn->query($sql) === TRUE) {
            // Data inserted successfully
            // You can update computer availability here
        } else {
            // Handle the error
            $error_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Check if a delete request was sent
    if (isset($_POST['delete'])) {
        // Get the ID of the record to delete
        $delete_id = $_POST['delete_id'];

        // Delete the record from the database
        $sql = "DELETE FROM daily_log WHERE id = $delete_id";

        if ($conn->query($sql) === TRUE) {
            // Record deleted successfully
            // You can add any necessary logic here
            header("Location: DailyLog.php"); // Redirect to refresh the page after deletion
            exit();
        } else {
            // Handle the error
            $error_message = "Error deleting record: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyLog- Kean University eSports Arena</title>
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

        /* Custom CSS for error messages */
        .error {
            color: red; /* Set the color of the error message to red */
            font-size: 14px; /* Adjust font size as needed */
        }

        /* Custom CSS for table */
        .daily-log-table {
            width: 100%;
            border-collapse: collapse;
        }

        .daily-log-table th,
        .daily-log-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .daily-log-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<header>
    <h1>Daily Log</h1>
</header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-secondary" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-secondary" href="availability.php">Computer Availability</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-secondary" href="OperationHours.php">Operation Hours</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-secondary" href="Download_Request_Form.php">Game Download Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-secondary" href="Rules.php">Rules</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-secondary" href="FAQ.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-secondary" href="Esports.html">Esports</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<main>
    <div id="daily-log-form">
        <form action="DailyLog.php" method="post">
            <br>
            <label for="date"><?php date_default_timezone_set('US/Eastern'); echo "Date:". date('m/d/Y'); ?></label>
            <br><br>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>
            <label for="last_name">Last Name:</label>
            <input type= "text" id="last_name" name="last_name" required>
            <br><br>
            <label for="computer_choice">Computer Choice (1-23):</label>
            <input type="number" id="computer_choice" name="computer_choice" required>
            <label for="student_id">Student ID:</label>
            <input type="number" id="student_id" name="student_id" required>
            <br><br>
            <input type="submit" value="Submit">
        </form>
        <?php if (!empty($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </div>

    <!-- Display the Daily Log table -->
    <br>
    <?php
    // Connect to the database to fetch daily log data
    $conn = new mysqli("localhost", "justin", "justin", "esports");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM daily_log";
    $result = $conn->query($sql);

    $entries_per_page = 10; // Number of entries to display per page
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get the current page from the URL parameter

    if ($result->num_rows > 0) {
        echo "<h2>Daily Log Table</h2>";
        echo "<table class='daily-log-table'>";
        echo "<tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Computer Choice</th>
                  <th>Date</th>
                  <th>Time Exit</th>
                  <th>Student ID</th>
                  <th>Action</th>
              </tr>";

        $offset = ($page - 1) * $entries_per_page; // Calculate the offset

        $query = "SELECT id, first_name, last_name, computer_choice, DATE_FORMAT(dte, '%m/%d/%Y %h:%i %p') as date_formatted, time_exit, student_id FROM daily_log LIMIT $offset, $entries_per_page";
        $result = $conn->query($query);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["first_name"] . "</td>";
            echo "<td>" . $row["last_name"] . "</td>";
            echo "<td>" . $row["computer_choice"] . "</td>";
            echo "<td>" . $row["date_formatted"] . "</td>";

            // Display the "Time Exit" as text or an input field for editing
            if (!isset($_GET['edit']) || $_GET['edit'] != $row["id"]) {
                echo "<td>" . $row["time_exit"] . " <a href='?edit=" . $row["id"] . "'>Edit</a></td>";
            } else {
                echo "<td>
                          <form method='post' action='DailyLog.php'>
                              <input type='text' name='new_time_exit' value='" . $row["time_exit"] . "'>
                              <input type='hidden' name='row_id' value='" . $row["id"] . "'>
                              <input type='submit' name='edit_time_exit' value='Save'>
                              <a href='DailyLog.php'>Cancel</a>
                          </form>
                      </td>";
            }

            echo "<td>" . $row["student_id"] . "</td>";

            // Add a delete button
            echo "<td><form method='post' action=''>
                      <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                      <input type='submit' name='delete' value='Delete'>
                  </form></td>";

            echo "</tr>";
        }
        echo "</table>";

        // Pagination links
        $query = "SELECT COUNT(*) AS total_entries FROM daily_log";
        $result = $conn->query($query);
        $total_entries = $result->fetch_assoc()['total_entries'];
        $total_pages = ceil($total_entries / $entries_per_page);

        echo "<div class='pagination'>";
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo "<span class='current-page'>$i</span>";
            } else {
                echo "<a href='?page=$i'>$i</a>";
            }
        }
        echo "</div>";
    }

    $conn->close();
    ?>
</main>
</body>
</html>
