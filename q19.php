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
    $book_no = $_POST['book_no'];
    $title = $_POST['title'];
    $edition = $_POST['edition'];
    $publisher = $_POST['publisher'];

    // Insert record (manual Book_no)
    $sql = "INSERT INTO book_details (Book_no, Title, Edition, Publisher)
            VALUES ('$book_no', '$title', '$edition', '$publisher')";

    if ($conn->query($sql)) {
        echo "<p style='color:green;' align='center'>
                ✅ Book added successfully!<br>
                📘 Book_no: <b>$book_no</b>
              </p>";
    } else {
        echo "<p style='color:red;' align='center'>
                ❌ Error inserting data: " . $conn->error . "
              </p>";
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

    <!-- Form to Add Book -->
    <form method="post" action="">
        <table border="1" align="center" cellpadding="5" cellspacing="0">
            <tr>
                <td>Book No:</td>
                <td><input type="number" name="book_no" required></td>
            </tr>
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

    <br><hr><br>

    <!-- Display All Books -->
    <h3 align="center">All Book Details</h3>

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
                        <td>{$row['Book_no']}</td>
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

