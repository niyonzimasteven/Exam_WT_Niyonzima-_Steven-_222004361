<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection variables (same as above)

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user input for security
    $productId = mysqli_real_escape_string($conn, $_POST['productId']);

    // SQL query to delete data
    $sql = "DELETE FROM products WHERE id=$productId";

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully!";
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    $conn->close();
}
?>
