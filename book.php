<?php
// Connect to MySQL
$servername = "localhost";
$username = "rinshad";
$password = "rinshadwebsql";
$database = "rinshad";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// When form is submitted
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $edition = $_POST['edition'];
    $publisher = $_POST['publisher'];

    // Insert record (book_no auto increments, so don’t include it)
    $sql = "INSERT INTO book_details (Title, Edition, Publisher)
            VALUES ('$title', '$edition', '$publisher')";

    if ($conn->query($sql)) {
        echo "<p style='color:green;' align='center'>✅ Book added successfully!</p>";
    } else {
        echo "<p style='color:red;' align='center'>❌ Error inserting data: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Information</title>
</head>
<body>
    <h2 align="center">BOOK INFORMATION</h2>

    <form method="post" action="">
        <table border="1" align="center" cellpadding="5" cellspacing="0">
            <tr>
                <td>Title:</td>
                <td><input type="text" name="title" required></td>
            </tr>
            <tr>
                <td>Edition:</td>
                <td><input type="text" name="edition" required></td>
            </tr>
            <tr>
                <td>Publisher:</td>
                <td><input type="text" name="publisher" required></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="submit" value="Add Book">
                </td>
            </tr>
        </table>
    </form>

    <h3 align="center">Book Details</h3>

    <table border="1" align="center" cellpadding="5" cellspacing="0">
        <tr style="background-color:lightgray;">
            <th>Book No</th>
            <th>Title</th>
            <th>Edition</th>
            <th>Publisher</th>
        </tr>

        <?php
        // Fetch and display all book records
        $result = $conn->query("SELECT * FROM book_details");

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['book_no']}</td>
                        <td>{$row['Title']}</td>
                        <td>{$row['Edition']}</td>
                        <td>{$row['Publisher']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4' align='center'>No books found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
