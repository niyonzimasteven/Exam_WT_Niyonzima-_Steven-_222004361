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
    $paymentID = $conn->real_escape_string($_POST["PaymentID"]);
    $bookingID = $conn->real_escape_string($_POST["BookingID"]);
    $amount = $conn->real_escape_string($_POST["Amount"]);
    $paymentDate = $conn->real_escape_string($_POST["PaymentDate"]);
    $method = $conn->real_escape_string($_POST["Method"]);

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO payments (PaymentID, BookingID, Amount, PaymentDate, Method) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $paymentID, $bookingID, $amount, $paymentDate, $method);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "New payment record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}

$conn->close();
?>
