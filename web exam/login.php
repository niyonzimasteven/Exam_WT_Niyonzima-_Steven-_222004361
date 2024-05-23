<?php
session_start();
$servername = "localhost"; // Replace with your database server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "sustainabletourism"; // Replace with your database name

// Create a new database connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user credentials (you should hash the password in the database)
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Valid login
        $_SESSION['username'] = $username;
        header("Location: home.html");
    }else {
            // Password is incorrect
            echo '<script>alert("Invalid username or password"); window.location.href = "login.html";</script>';
        }
    } else {
        // Username not found
        echo '<script>alert("Invalid username or password"); window.location.href = "login.html";</script>';
}
?>
