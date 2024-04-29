<?php
require "C:\Program Files\Ampps\www\cps4301\PHPMailer-master\src\PHPMailer.php";
require "PHPMailer-master/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
} 
else {
    $dailyLogOption = '';
    $logoutOption = '';
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["fullName"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Insert the request data into a SQL database (replace with your database details)
    $db = new PDO("mysql:host=localhost;dbname=esports", "justin", "justin");
    $stmt = $db->prepare("INSERT INTO request_info_db (name, email, event_description, request_time) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$name, $email, $message]);

    // Create a PHPMailer instance
    $mail = new PHPMailer;

    // Set your SMTP server and authentication details
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'Indemnity992@gmail.com';
    $mail->Password = 'fppf lffg fxnh lmuu';
    $mail->SMTPSecure = 'ssl'; // Use 'ssl' or 'tls' based on your SMTP server's requirements
    $mail->Port = 465; // Use the appropriate port

    // Set the "From" address
    $mail->setFrom('esports@example.com', 'Esports');

    // Send confirmation email to the user
    $mail->addAddress($email);
    $mail->Subject = "Request Info form received";
    $mail->Body = "Thank you for submitting a form in Request Info. We have received the following information:\n\n";
    $mail->Body .= "Name: $name\nEmail: $email\nMessage: $message\nRequest Time: " . date("Y-m-d H:i:s");

    if (!$mail->send()) {
        $message = "Error: " . $mail->ErrorInfo;
    } else {
        $message = "Request submitted successfully!\n\nA receipt has been to sent to your email.";
    }

    // Send email to the website owner
    $mail->clearAddresses();
    $mail->addAddress('justinpeters992@gmail.com');
    $mail->Subject = "New Request Info form";
    $mail->Body = "A new Request Info form has been received:\n\n";
    $mail->Body .= "Name: $name\nEmail: $email\nMessage: $message\nRequest Time: " . date("Y-m-d H:i:s");

    if (!$mail->send()) {
        echo "Error: " . $mail->ErrorInfo;
    }
} else {
    echo "Invalid request method.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Info - Kean University eSports Arena</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Request Info</h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="availability.php">Computer Availability</a></li>
            <li><a href="OperationHours.php">Operation Hours</a></li>
            <li><a href="Download_Request_Form.php">Game Download Request</a></li>
            <li><a href="Rules.php">Rules</a></li>
            <li><a href="FAQ.php">FAQ</a></li>
            <?php echo $dailyLogOption; ?>
            <?php echo $logoutOption; ?>
        </ul>
    </nav>
        </ul>
    </nav>
    <main>
        <?php
        if (!empty($message)) {
            echo '<p>' . $message . '</p>';
        }
        ?>
    </main>
