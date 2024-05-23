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
    $reviewID = $conn->real_escape_string($_POST["ReviewID"]);
    $userID = $conn->real_escape_string($_POST["UserID"]);
    $tourID = $conn->real_escape_string($_POST["TourID"]);
    $rating = $conn->real_escape_string($_POST["Rating"]);
    $comment = $conn->real_escape_string($_POST["Comment"]);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO reviews (ReviewID, UserID, TourID, Rating, Comment) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $reviewID, $userID, $tourID, $rating, $comment);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "New review record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
