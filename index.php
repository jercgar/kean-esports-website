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

$sql = "SELECT computer_choice, time_exit FROM daily_log";
$result = $conn->query($sql);

// Create an array to store computer availability
$computerAvailability = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $computerChoice = $row["computer_choice"];
        $timeExit = $row["time_exit"];

        // Set availability based on the presence of time_exit
        $availability = empty($timeExit) ? "Not Available" : "Available";

        $computerAvailability[$computerChoice] = $availability;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kean University eSports Arena</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoJtKh7z7lGz7fuP4F8nfdFvAOA6Gg/z6Y5J6XqqyGXYM2ntXU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqFjcJ6pajs/rfdfs3SO+kD4Ck5BdPtF+to8xMp9Mvc" crossorigin="anonymous"></script>
    <meta http-equiv="refresh" content="60"> <!-- Auto-refresh every 60 seconds -->
</head>
<body>
    <header>
        <h1>Kean University eSports Arena</h1>
    </header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php echo $loginOption; ?>
                <li class="nav-item">
                    <a class="nav-link" href="availability.php">Computer Availability</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="OperationHours.php">Operation Hours</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Download_Request_Form.php">Game Download Request</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Main_Stage_Reservation_Form.php">Main Stage Reservation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Rules.php">Rules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="FAQ.php">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Esports.html">Esports</a>
                </li>
                <?php echo $dailyLogOption; ?>
                <?php echo $logoutOption; ?>
            </ul>
        </div>
    </div>
</nav>
    <main>
        <h2>Welcome to Kean University eSports Arena</h2>
        <h3>Home for all things video games</h3>
        <div class="image-container">
            <img src="KeanEsportsImage.png" alt="Home Page Image" class="main-image">
         </div>  
        <p>Follow us on Social Media</p>
        <div class="social-icons-container">
        <a href="https://twitter.com/Kean_Esports" target="_blank">
        <img src="xlogo.png" alt="Twitter Logo" class="social-icon" width="90" height="90">
    </a>
        <a href="https://www.twitch.tv/kean_esports" target="_blank">
        <img src="twitchlogo.png" alt="Twitch Logo" class="social-icon" width="90" height="90">
    </a>
        <a href="https://www.instagram.com/kean_esports" target="_blank">
        <img src="instagram.png" alt="Instagram Logo" class="social-icon" width="90" height="90">
    </a>
    <a href="https://discord.gg/j2ShSXuQ" target="_blank">
        <img src="DiscordLogo.png" alt="Discord Logo" class="social-icon" width="90" height="90">
    </a>
</div>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
