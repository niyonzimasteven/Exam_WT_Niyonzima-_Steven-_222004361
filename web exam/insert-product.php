<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection variables
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sustainabletourism";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user inputs for security
    $productName = mysqli_real_escape_string($conn, $_POST['productName']);
    $productPrice = mysqli_real_escape_string($conn, $_POST['productPrice']);

    // SQL query to insert data
    $sql = "INSERT INTO products (name, price) VALUES ('$productName', '$productPrice')";

    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
