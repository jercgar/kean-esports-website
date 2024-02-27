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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email_discord = $_POST['Email/Discord'];
    $game = $_POST['Game'];
    $pc_platform = $_POST['PC Platform'];

    // Construct message to be sent to Discord
    $message = "New game download request:\n";
    $message .= "Email/Discord: $email_discord\n";
    $message .= "Game: $game\n";
    $message .= "PC Platform: $pc_platform\n";

    // Discord webhook URL
    $webhookUrl = "https://discord.com/api/webhooks/1209247935720595477/DtnRvHsVgD4yvvuX0AdclgYQECCFWqyFWxkTs5ELSZAtQAlH-_W94eODjFAh2EDdi4_T";

    // Prepare webhook payload
    $data = array(
        'content' => $message
    );

    // Convert payload to JSON
    $jsonData = json_encode($data);

    // Set up cURL to make POST request to Discord webhook without SSL certificate verification
    $ch = curl_init($webhookUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL certificate verification

    // Execute cURL request
    $response = curl_exec($ch);

    // Check for errors
    if(curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo 'Message sent to Discord successfully!';
    }

    // Close cURL session
    curl_close($ch);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Download Request Form - Kean University eSports Arena</title>
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
    <header class="container-fluid">
        <h1>Game Download Request Form</h1>
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
    <main class="container">
        <section>
            <form id="downloadForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="mb-3">
                    <label for="Email/Discord" class="form-label">Discord</label>
                    <input type="text" class="form-control" id="Email/Discord" name="Email/Discord" placeholder="Enter your Esports discord name" required>
                </div>
                <div class="mb-3">
                    <label for="Game" class="form-label">Game</label>
                    <input type="Game" class="form-control" id="Game" name="Game" placeholder="Call of Duty" required>
                </div>
                <div class="mb-3">
                    <label for="PC Platform" class="form-label">PC Platform</label>
                    <select class="form-select" id="PC Platform" name="PC Platform" required>
                        <option value="Steam">Steam</option>
                        <option value="Epic">Epic Games</option>
                        <option value="Ubisoft">Ubisoft Connect</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <!-- Message to display upon successful submission -->
            <div id="submissionMessage" class="mt-3"></div>
        </section>
    </main>

    <!-- Include Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('downloadForm').addEventListener('submit', async (event) => {
            event.preventDefault(); // Prevent default form submission
            
            const formData = new FormData(event.target);
            
            // Construct the message content using form data
            let messageContent = 'New download request:\n';
            for (const [name, value] of formData) {
                messageContent += `${name}: ${value}\n`;
            }

            try {
                await sendMessageToDiscord(messageContent);
                document.getElementById('submissionMessage').textContent = 'Download request submitted successfully!';
                document.getElementById('submissionMessage').classList.remove('text-danger');
                document.getElementById('submissionMessage').classList.add('text-success');
                // Optionally clear the form fields or perform other actions
            } catch (error) {
                console.error('Error sending message to Discord:', error.message);
                document.getElementById('submissionMessage').textContent = 'Failed to submit download request. Please try again later.';
                document.getElementById('submissionMessage').classList.remove('text-success');
                document.getElementById('submissionMessage').classList.add('text-danger');
            }
        });

        // Function to send message to Discord webhook
        const sendMessageToDiscord = async (message) => {
            const webhookUrl = 'https://discord.com/api/webhooks/1209247935720595477/DtnRvHsVgD4yvvuX0AdclgYQECCFWqyFWxkTs5ELSZAtQAlH-_W94eODjFAh2EDdi4_T';
            const payload = { content: message };

            const response = await fetch(webhookUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(payload),
            });

            if (!response.ok) {
                throw new Error('Failed to send message to Discord');
            }
        };
    </script>
</body>
</html>
