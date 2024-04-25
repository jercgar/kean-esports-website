<?php include 'dbtab.php';

// Initialize arena status if not set in session
if (!isset($_SESSION['arena_status'])) {
    $_SESSION['arena_status'] = "Arena closed";
}

// Toggle arena status if logged in
if (isset($_SESSION['username']) && isset($_POST['toggleStatus'])) {
    $_SESSION['arena_status'] = ($_SESSION['arena_status'] == "Arena closed") ? "Arena open" : "Arena closed";

    // Move entries to history table if the arena is closing
    if ($_SESSION['arena_status'] == "Arena closed") {
        $moveEntriesSql = "INSERT INTO log_table (id, first_name, last_name, computer_choice, time_entered, time_exit, student_id, dte)
                           SELECT id, first_name, last_name, computer_choice, time_entered, time_exit, student_id, dte
                           FROM daily_log";
        $conn->query($moveEntriesSql);
    }

    // Clear active table
    $clearSql = "DELETE FROM daily_log";
    $conn->query($clearSql);

    // Redirect to the same page to prevent form resubmission
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

// Set arena color based on status
$arenaColor = ($_SESSION['arena_status'] == "Arena closed") ? "red" : "green";

// Update computer availability based on arena status
$availability = ($_SESSION['arena_status'] == "Arena closed") ? "not-available" : "available";

// Display computer availability based on the updated status
$computerAvailability = array_fill(1, 23, $availability);
if ($_SESSION['arena_status'] == "Arena closed") {
    $sql = "SELECT computer_choice FROM daily_log WHERE time_exit IS NOT NULL";
} else {
    $sql = "SELECT computer_choice FROM daily_log WHERE time_exit IS NULL";
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $computerAvailability[$row['computer_choice']] = "not-available";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Availability</title>
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

        /* Additional CSS for computer availability */
        #computer-availability {
            margin: 20px auto;
            max-width: 600px;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 10px;
        }

        #computer-availability ul {
            list-style-type: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); /* Auto-fit columns with minimum width */
            gap: 10px; /* Add some gap between items */
        }

        #computer-availability ul li {
            padding: 10px;
            border-radius: 5px;
            text-align: center; /* Center align the text */
            font-weight: bold;
            transition: background-color 0.3s ease; /* Smooth transition */
        }

        #computer-availability ul li.available {
            background-color: #28a745; /* Green for available */
            color: white;
        }

        #computer-availability ul li.not-available {
            background-color: #dc3545; /* Red for not available */
            color: white;
        }

        /* Additional CSS for arena status */
        #arena-status {
            text-align: center;
            font-size: 72px;
            margin-bottom: 20px;
            color: <?php echo $arenaColor; ?>; /* Set color dynamically */
        }

        #toggle-button {
            margin-bottom: 10px;
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
        <h1>Computer Availability</h1>
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
                    <?php echo $loginOption; ?>
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
                        <a class="nav-link" href="https://discord.gg/VEsmrtBM" target="_blank"><img src="logos/DiscordLogo.png" alt="Discord Logo" class="social-icon" width="30" height="30"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div id="arena-status">
            <?php echo $_SESSION['arena_status']; ?>
        </div>
        <form method="POST" id="toggle-button" onsubmit="return confirmToggle()">
            <input type="hidden" name="currentStatus" value="<?php echo $_SESSION['arena_status']; ?>">
            <?php if (isset($_SESSION['username'])): ?>
                <button type="submit" name="toggleStatus">Toggle Arena Status</button>
            <?php endif; ?>
        </form>
        <div id="computer-availability">
            <ul>
                <?php
                foreach ($computerAvailability as $computerNumber => $status) {
                    $availabilityClass = ($status == "not-available") ? "not-available" : "available";
                    echo "<li class='$availabilityClass'>Computer $computerNumber</li>";
                }
                ?>
            </ul>
        </div>
    </main>
    <script>
        function confirmToggle() {
            if ("<?php echo $_SESSION['arena_status']; ?>" === "Arena closed") {
                return true; // No need for confirmation if the arena is already closed
            }
            return confirm("WARNING: ALL RECORDS IN THE DAILY LOG TABLE WILL BE ERASED AND MOVED TO THE DAILY LOG HISTORY TABLE AFTER TOGGLING. ONLY TOGGLE AT OPEN TIME AND TOGGLE AT CLOSING TIME. ARE YOU SURE YOU WANT TO CONTINUE?");
        }
    </script>
</body>
</html>
