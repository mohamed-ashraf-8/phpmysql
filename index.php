<!DOCTYPE html>
<html>

<head>
  <title>Book Form</title>
</head>

<body>
  <form method="POST" action="index.php">
    <label for="bookName">Book Name:</label>
    <input type="text" name="bookName" id="bookName" required><br>

    <label for="price">Price:</label>
    <input type="number" name="price" id="price" step="0.01" required><br>

    <label for="author">Author:</label>
    <input type="text" name="author" id="author" required><br>

    <input type="submit" value="Submit">
  </form>
</body>

</html>

<?php

$serverName = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

// Create connection
$conn = new mysqli($serverName, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $bookName = $_POST['bookName'];
  $price = $_POST['price'];
  $author = $_POST['author'];

  // Use the retrieved data as needed
  echo "Book Name: " . $bookName . "<br>";
  echo "Price: " . $price . "<br>";
  echo "Author: " . $author . "<br>";

  // Perform further processing or database operations with the data
  // ...
}

// Insert data into MySQL table
$sql = "INSERT INTO books (book_name, price, author) VALUES ('Hebta', '200', 'Mohamed')";

if ($conn->query($sql) === TRUE) {
  echo "Data inserted successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Retrieve data from MySQL table
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

// Display data in a table
if ($result->num_rows > 0) {
  echo "<table>
            <tr>
                <th>Book Name</th>
                <th>Price</th>
                <th>Author</th>
            </tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
                <td>" . $row['book_name'] . "</td>
                <td>" . $row['price'] . "</td>
                <td>" . $row['author'] . "</td>
            </tr>";
  }
  echo "</table>";
} else {
  echo "No data found.";
}

$conn->close();