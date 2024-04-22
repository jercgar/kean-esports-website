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

        /* Additional CSS for vertical line */
        .vertical-line {
            border-left: 1px solid #ccc;
            height: 30px; /* Adjust height as needed */
            margin: 0 10px; /* Adjust margin as needed */
        }
         /* Additional CSS for submission message */
         #submissionMessage {
            font-weight: bold; /* Make the text bold */
        }
    </style>
</head>
<body>
    <header class="container-fluid">
        <h1>Game Download Request Form</h1>
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
                        <a class="btn btn-outline-light" href="Rules.php">Rules</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="FAQ.php">FAQ</a>
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
                        <a class="nav-link" href="https://discord.gg/MqYR638K" target="_blank"><img src="logos/DiscordLogo.png" alt="Discord Logo" class="social-icon" width="30" height="30"></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <main class="container">
        <section>
            <h1>Enter a game you would like installed onto the computers below:</h1>
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
                    <select class="form-select" id="PC Platform" name="PC Platform"placeholder="Platform" required>
                        <option value="Select-Platform">Select Platform</option>
                        <option value="Steam">Steam</option>
                        <option value="Epic">Epic Games</option>
                        <option value="Ubisoft">Ubisoft Connect</option>
                        <option value="Battle.net">Battle.net</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Additional Info" class="form-label">Additional Information</label>
                    <textarea class="form-control" id="Additional Info" name="Additional Info" rows="3" placeholder="Enter any additional information here"></textarea>
                </div>
                <button type="submit" class="btn btn-outline-light">Submit</button>
                <!-- Toast container -->
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <!-- Toast -->
                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong class="me-auto">Success</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            Download request submitted successfully!
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
    <br><br><br><br><br>
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
    <!-- Include Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('downloadForm').addEventListener('submit', async (event) => {
            event.preventDefault(); // Prevent default form submission
            
            const formData = new FormData(event.target);
            
            // Construct the message content using form data
            let messageContent = 'New Download Request:\n';
            for (const [name, value] of formData) {
                messageContent += `${name}: ${value}\n`;
            }

            try {
                await sendMessageToDiscord(messageContent);
                // Show the toast
                var toastElement = document.querySelector('.toast');
                var toast = new bootstrap.Toast(toastElement);
                toast.show();
                // Clear the form fields
                document.getElementById('downloadForm').reset();
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