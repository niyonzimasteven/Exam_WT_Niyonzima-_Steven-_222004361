<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection variables (same as above)

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user inputs for security
    $productId = mysqli_real_escape_string($conn, $_POST['productId']);
    $updatedProductName = mysqli_real_escape_string($conn, $_POST['updatedProductName']);
    $updatedProductPrice = mysqli_real_escape_string($conn, $_POST['updatedProductPrice']);

    // SQL query to update data
    $sql = "UPDATE products SET name='$updatedProductName', price='$updatedProductPrice' WHERE id=$productId";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully!";
    } else {
        echo "Error updating product: " . $conn->error;
    }

    $conn->close();
}
?>
