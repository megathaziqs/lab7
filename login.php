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
$password = $_POST['password'];

// Prepare and execute query
$stmt = $conn->prepare("SELECT * FROM users WHERE matric = ? AND password = ?");
$stmt->bind_param("ss", $matric, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Successful login, redirect to display page with success parameter
    header("Location: display_users.php?login=success");
    exit();
} else {
    // Failed login, show error message
    echo "Invalid username or password, try <a href='login.html'>login</a> again.";
}

// Close the connection
$stmt->close();
$conn->close();
?>
