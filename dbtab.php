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
    $username = $_SESSION['username'];
    $query = "SELECT role FROM workers WHERE first_name = ?";
    // Prepare the statement
    $stmt = $conn->prepare($query);
    // Bind the parameter
    $stmt->bind_param("s", $username);
    // Execute the query
    $stmt->execute();
    // Bind the result
    $stmt->bind_result($userRole);
    // Fetch the result
    $stmt->fetch();
    
    // Close the statement
    $stmt->close();
    $_SESSION['user_role'] = $userRole;

    if ($userRole == 'admin') {
        $dailyLogOption = '<li class="nav-item"><a class="btn btn-outline-light" href="DailyLog.php">Daily Log</a></li>';
        $logoutOption = '<li class="nav-item"><a class="btn btn-outline-danger" href="logout.php">Logout</a></li>';
        $accountManagerOption = '<li class="nav-item"><a class="btn btn-outline-light" href="Account_Manager.php">Administration</a></li>';
        $historyOption = '<li class="nav-item"><a class="btn btn-outline-light" href="history.php">History</a></li>';
        $loginOption = '';
    } 
    elseif ($userRole == 'worker') {
        $dailyLogOption = '<li class="nav-item"><a class="btn btn-outline-light" href="DailyLog.php">Daily Log</a></li>';
        $logoutOption = '<li class="nav-item"><a class="btn btn-outline-danger" href="logout.php">Logout</a></li>';
        $historyOption = '<li class="nav-item"><a class="btn btn-outline-light" href="history.php">History</a></li>';
        $accountManagerOption = '';
        $loginOption = '';
    }
    
}
    else {
        $dailyLogOption = '';
        $logoutOption = '';
        $accountManagerOption = '';
        $historyOption = '';
        $loginOption = '<li class="nav-item"><a class="btn btn-outline-success" href="login.php">Login</a></li>';
    }
?>