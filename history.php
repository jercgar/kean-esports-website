<?php include 'dbtab.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kean University eSports Arena</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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
        <h1>Daily Log History</h1>
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
                    <?php echo $accountManagerOption; ?>
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
    <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="dailyLogHistory" role="tabpanel" aria-labelledby="dailyLogHistory-tab">
                <br>
                <form id="search_form" method="post" onchange="showCalender()">
                    <select name="search_criteria">
                        <option value="computer">Computer Number</option>
                        <option value="date">Date</option>
                    </select>
                    <input type="text" name="search_query" placeholder="Search...">
                    <button type="submit">Search</button>
                    <button type="button" onclick="window.location.href=window.location.href">Clear</button>
                </form>

                <script>
                    function showCalender() {
                        var search_criteria = document.getElementsByName("search_criteria")[0].value;
                        var searchInput = document.getElementsByName("search_query")[0];
    
                        if (search_criteria === "date") {
                            searchInput.type = "date";
                        } else {
                            searchInput.type = "text";
                        }
                    }
                </script>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Computer Choice</th>
                                <th>Time Entered</th>
                                <th>Time Exit</th>
                                <th>Student ID</th>
                            </tr>
                        </thead>
                        <body>
                            <?php
                            // Retrieve data from log_table
                            // Fetch search query and criteria from the form
                            $sql = "SELECT CONCAT(first_name, ' ', last_name) AS full_name, computer_choice, dte, time_exit, student_id FROM log_table";

                           if ($_SERVER["REQUEST_METHOD"] == "POST") {     
                                $search_query = $_POST['search_query'];
                                $search_criteria = $_POST['search_criteria'];
                                // Construct SQL query based on selected criteria

                                if ($search_criteria === "computer") {
                                    $sql .= " WHERE computer_choice LIKE '%$search_query%'";
                                } elseif ($search_criteria === "date") {
                                    $sql .= " WHERE dte LIKE '%$search_query%'";
                                }
                            }
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["full_name"] . "</td>";
                                    echo "<td>" . $row["computer_choice"] . "</td>";
                                    echo "<td>" . $row["dte"] . "</td>";
                                    echo "<td>" . ($row["time_exit"] !== null ? $row["time_exit"] : "???") . "</td>";
                                    echo "<td>" . $row["student_id"] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No records found</td></tr>";
                            }
                            ?>
                        </body>
                    </table>
                </div>
            </div>
            <!-- Add more tab panes here -->
        </div>
    </div>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>