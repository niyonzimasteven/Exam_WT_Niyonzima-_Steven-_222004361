<?php
// Assuming you have a database connection established
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
    $booking_id = $_POST["booking_id"];
    $user_id = $_POST["user_id"];
    $room_id = $_POST["room_id"];
    $check_in_date = $_POST["check_in_date"];
    $check_out_date = $_POST["check_out_date"];
    $num_guests = $_POST["num_guests"];
    $total_cost = $_POST["total_cost"];
    $booking_status = $_POST["booking_status"];

    // Prepare and execute the SQL query
    $sql = "INSERT INTO booking (booking_id, user_id, room_id, check_in_date, check_out_date, num_guests, total_cost, booking_status)
            VALUES ('$booking_id', '$user_id', '$room_id', '$check_in_date', '$check_out_date', '$num_guests', '$total_cost', '$booking_status')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
