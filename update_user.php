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

// Retrieve user data
$sql = "SELECT * FROM users WHERE matric = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $matric);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <form action="update_user_process.php" method="post">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" value="<?php echo $user['matric']; ?>" readonly><br><br>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required><br><br>
        
        <label for="role">Access Level:</label>
        <input type="text" id="role" name="role" value="<?php echo $user['role']; ?>" required><br><br>
        
        <input type="submit" value="Update">
    </form>
    <br>
    <a href="display_users.php">Cancel</a>
</body>
</html>

<?php
// Close the connection
$stmt->close();
$conn->close();
?>
