<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tour Information</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <!-- Existing styles remain unchanged -->
</head>
<body style="background-color: lightblue;">
  <header>
    <!-- Navigation links remain unchanged -->
  </header>
  <body style="background-color: yellowgreen;">
    <h1>Tour Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
      <label for="tour_id">Tour ID:</label>
      <input type="number" id="tour_id" name="tour_id" required><br><br>

      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required><br><br>

      <label for="description">Description:</label>
      <input type="text" id="description" name="description" required><br><br>

      <label for="location">Location:</label>
      <input type="text" id="location" name="location" required><br><br>

      <label for="price">Price:</label>
      <input type="number" id="price" name="price" required><br><br>

      <label for="duration">Duration:</label>
      <input type="text" id="duration" name="duration" required><br><br>

      <label for="maxparticipants">Max Participants:</label>
      <input type="number" id="maxparticipants" name="maxparticipants" required><br><br>

      <input type="submit" name="add" value="Insert"><br><br>

      <a href="./home.html">Go Back to Home</a>
    </form>

    <?php
    include('database_connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
        $tour_id = $_POST['tourid'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $location = $_POST['location'];
        $price = $_POST['price'];
        $duration = $_POST['duration'];
        $maxparticipants = $_POST['maxparticipants'];

        $stmt = $connection->prepare("INSERT INTO tours (tourid, name, description, location, price, duration, maxparticipants) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssdis", $tourid, $name, $description, $location, $price, $duration, $maxparticipants);

        if ($stmt->execute()) {
            echo "New tour record has been added successfully.<br><br><a href='tour.php'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    }
    ?>

    <section>
      <h2>Tour Details</h2>
      <table>
        <tr>
          <th>Tour ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Location</th>
          <th>Price</th>
          <th>Duration</th>
          <th>Max Participants</th>
          <th>Delete</th>
          <th>Update</th>
        </tr>
          <?php
        $sql = "SELECT * FROM courses";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Tour ID']}</td>
                        <td>{$row['Name']}</td>
                        <td>{$row['Description']}</td>
                        <td>{$row['Location']}</td>
                        <td>{$row['Price']}</td>
                        <td>{$row['Duration']}</td>
                        <td>{$row['>Max Participants']}</td>
                        <td><a style='padding:4px' href='delete_tour.php?tour_id={$row['course_id']}'>Delete</a></td> 
                        <td><a style='padding:4px' href='update_tour.php?tour_id={$row['course_id']}'>Update</a></td> 
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No data found</td></tr>";
        }
        ?>
      </table>
    </section>

    <footer>
        <!-- PHP code to fetch and display tour details from the database -->
      </table>
    </section>

    <footer>
      <h2>UR CBE BIT © 2024 ® Designed by: @murara</h2>
    </footer>

  </body>
</html>
