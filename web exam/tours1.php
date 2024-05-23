<?php
// Replace the placeholders with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sustainabletourism";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and prevent SQL injection
    $tourID = $conn->real_escape_string($_POST["TourID"]);
    $name = $conn->real_escape_string($_POST["Name"]);
    $description = $conn->real_escape_string($_POST["Description"]);
    $location = $conn->real_escape_string($_POST["Location"]);
    $price = $conn->real_escape_string($_POST["Price"]);
    $duration = $conn->real_escape_string($_POST["Duration"]);
    $maxParticipants = $conn->real_escape_string($_POST["MaxParticipants"]);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO tours (TourID, Name, Description, Location, Price, Duration, MaxParticipants) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssdis", $tourID, $name, $description, $location, $price, $duration, $maxParticipants);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "New tour record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
