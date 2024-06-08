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

// Retrieve form data
$matric = $_POST['matric'];
$name = $_POST['name'];
$role = $_POST['role'];

// Prepare and execute update query
$sql = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $role, $matric);

if ($stmt->execute()) {
    header("Location: display_users.php?update=success");
} else {
    echo "Error updating record: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
