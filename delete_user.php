<?php
// Database connection details
$servername = "localhost";
$username = "root"; // Adjust if necessary
$password = ""; // Adjust if necessary
$dbname = "Lab_7";
$port = 3307; // Specify the port number

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$matric = $_GET['matric'];

// Prepare and execute delete query
$sql = "DELETE FROM users WHERE matric = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $matric);

if ($stmt->execute()) {
    header("Location: display_users.php?delete=success");
} else {
    echo "Error deleting record: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
