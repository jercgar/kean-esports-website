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
    <title>Main Stage Reservation Form - Kean University eSports Arena</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        
    </style>    
</head>
<body>
    <header>
        <h1>Main Stage Reservation Form</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php echo $loginOption; ?>
            <li><a href="availability.php">Computer Availability</a></li>
            <li><a href="OperationHours.php">Operation Hours</a></li>
            <li><a href="Download_Request_Form.php">Game Download Request</a></li>
            <li><a href="Rules.php">Rules</a></li>
            <li><a href="FAQ.php">FAQ</a></li>
            <li><a href="Esports.html">Esports</a></li>
            <?php echo $dailyLogOption; ?>
            <?php echo $logoutOption; ?>
        </ul>
    </nav>
<body>
    <main>
    <form action="process_reservation.php" method="post">
        <label for="name">Name:</label>
        <input id="name" type="text" name="name" required><br><br>

        <label for="email">Email:</label>
        <input id="email" type="email" name="email" required><br><br>

        <label for="event_description">Event Description:</label>
        <input id="text" type="text" name="event_description" required><br><br>

        <input type="submit" value="Submit">
    </form>
</main>
</body>
</html>
