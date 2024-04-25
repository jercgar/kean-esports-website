<?php
include 'dbtab.php';

$error_message = "";

// Process the login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["username"];
    $password = $_POST["password"];

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM workers WHERE first_name = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ss", $login, $password);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Successful login, set a session variable to remember the user
        $_SESSION['username'] = $login;

        // Redirect to index.html
        header("Location: index.php");
        exit();
    } else {
        // Invalid credentials, display an error message
        $error_message = "Invalid username or password.";
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

        /* Additional CSS for tooltip */
/* Additional CSS for tooltip */
.tooltip {
    position: relative;
    display: inline-block;
}

.input-group {
    position: relative;
}

.tooltip .tooltip-icon {
    position: absolute;
    top: 50%;
    right: 20px; /* Adjust the distance from the right edge */
    transform: translateY(-50%);
    color: #007bff; /* Change color as needed */
    font-size: 18px;
    cursor: pointer;
}


.tooltip .tooltip-icon:hover + .tooltiptext {
    display: block;
}

.tooltip .tooltiptext {
    display: none;
    width: auto;
    max-width: 200px;
    background-color: #007bff; /* Change color as needed */
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 10px;
    position: absolute;
    z-index: 1;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
}

.tooltip .tooltiptext::after {
    content: '';
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translateX(-50%);
    border-width: 5px;
    border-style: solid;
    border-color: transparent transparent #007bff transparent;
}

.tooltip .tooltiptext.show {
    display: block;
}

    </style>
</head>
<body>
    <header>
        <h1>Login</h1>
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
                        <a class="nav-link" href="https://discord.gg/VEsmrtBM" target="_blank"><img src="logos/DiscordLogo.png" alt="Discord Logo" class="social-icon" width="30" height="30"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
    <div id="login-form">
        <br>
        <!-- Add disclaimer text here -->
        <p>This page is intended for workers/admins only. Unauthorized access is prohibited.</p>
        <form action="login.php" method="post">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="textbox" id="username" name="username" required>
                <span class="tooltip-icon" title="This information should have been given by the administrator"><i class="fas fa-question-circle"></i></span>
            </div>
            <br><br>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <span class="tooltip-icon" title="This information should have been given by the administrator"><i class="fas fa-question-circle"></i></span>
            </div>
            <br><br>
            <input type="submit" value="Login">
        </form>
        <br>
        <div id="error_message"><?php if (!empty($error_message)) echo "<font color='red'>$error_message</font>" ?></div>
    </div>
</main>




</body>
</html>

