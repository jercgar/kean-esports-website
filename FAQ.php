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
    <title>FAQ</title>
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
        <h1>Frequently Asked Questions</h1>
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
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="AboutUs.html">About</a>
                    </li>
                    <li class="nav-item">
                    <a class="btn btn-outline-light" href="availability.php">PC Availability</a>
                    </li>
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
                        <a class="btn btn-outline-light" href="Esports.html">Esports</a>
                    </li>
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
                        <a class="nav-link" href="https://discord.gg/VEsmrtBM" target="_blank"><img src="logos/DiscordLogo.png" alt="Discord Logo" class="social-icon" width="30" height="30"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
    <br>
        <ul class="faq-list">
            <li>
                <h3>Are we allowed to bring our own equipment?</h3>
                <p>Yes. Everyone is allowed to bring their own equipment, but you are responsible for ensuring that the equipment doesn't cause an issue with the existing hardware or software. Anything you unplug should be plugged back in after your session is over.</p>
            </li>
            <li>
                <h3>Who is allowed to be in the main stage area?</h3>
                <p>Only the students/coaches who are currently on one of our eSports teams are allowed in the main stage. All are welcome to be spectators during game time.</p>
            </li>
            <li>
                <h3>How can I get onto one of the teams?</h3>
                <p>Tryouts are held at the beginning of each semester. Tryouts for each game are announced on the program's Discord channel.</p>
            </li>
            <li>
                <h3>Can I work at the arena? If so, how do I apply?</h3>
                <p>Yes! Students are always welcome to apply as arena workers. If you are a graduate, we are also looking for nighttime arena managers and coaches. To start the process, email the program director, Joseph Sarnoski or go to our Esports tab, click request info and fill in the information. </p>
            </li>
            <li>
                <h3>What games are offered for competitive play?</h3>
                <p>We offer a wide range of games for competitive play such as Valorant, League of Legends, Overwatch 2, Rocket League, Rainbow Six Siege, Super Smash Bros, Street Fighter 6, EA Sports FC, NBA 2K, Madden, and Heartstone. </p>
            </li>
        </ul>
    </main>
    <br><br><br><br><br><br>
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
</body>
</html>
