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

// Check for login success parameter
$loginSuccess = isset($_GET['login']) && $_GET['login'] == 'success';

// Retrieve data from the users table
$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Users List</title></head>";
echo "<body>";

if ($loginSuccess) {
    echo "<p style='color: green;'>Login successful!</p>";
}

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Matric</th><th>Name</th><th>Level</th><th>Action</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["matric"] . "</td><td>" . $row["name"] . "</td><td>" . $row["role"] . "</td>";
        echo "<td><a href='update_user.php?matric=" . $row["matric"] . "'>Update</a> | <a href='delete_user.php?matric=" . $row["matric"] . "'>Delete</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

echo "</body>";
echo "</html>";

// Close the connection
$conn->close();
?>
