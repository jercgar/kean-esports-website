<?php
session_start();

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
} 
else {
    $dailyLogOption = '';
    $logoutOption = '';
    $loginOption = '<li><a href="login.php">Login</a></li>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operation Hours - Kean University eSports Arena</title>
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
    </style>
</head>
<body>
    <header>
        <h1>Operation Hours</h1>
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
        <h2>Open Play Hours</h2>
        <p>Our eSports Arena is open during the following hours for open play:</p>
        <ul>
            <li>Monday: 12:00 PM - 6:00 PM</li>
           <li>Tuesday: 12:00 PM - 6:00 PM</li>
           <li>Wednesday: 12:00 PM - 6:00 PM</li>
           <li>Thursday: 12:00 PM - 6:00 PM</li>
           <li>Friday: 12:00 PM - 6:00 PM</li>
           <li>Saturday: CLOSED</li>
           <li>Sunday: CLOSED</li>
        </ul>

        <h2>Competitive Play Hours</h2>
        <p>Our competitive play hours for spectating are:</p>
        <ul>
            <li>Monday: 8:00 PM - 10:00 PM</li>
           <li>Tuesday: 8:00 PM - 10:00 PM</li>
           <li>Wednesday: 8:00 PM - 10:00 PM</li>
           <li>Thursday: CLOSED</li>
           <li>Friday: 8:00 PM - 10:00 PM</li>
           <li>Saturday: CLOSED</li>
           <li>Sunday: CLOSED </li>
        </ul>
    </main>
</body>
</html>
