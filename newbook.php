<?php
// DB connection
$conn = new mysqli("localhost", "rinshad", "rinshadwebsql", "rinshad");
if ($conn->connect_error) die("DB Error");

// Insert when submitted
if (!empty($_POST['submit'])) {
    $book_no   = $_POST['book_no'];
    $title     = $_POST['title'];
    $edition   = $_POST['edition'];
    $publisher = $_POST['publisher'];

    $conn->query("INSERT INTO book_details (Book_no, Title, Edition, Publisher)
                  VALUES ('$book_no', '$title', '$edition', '$publisher')");
}
?>

<!DOCTYPE html>
<html>
<head><title>Book Info</title></head>
<body>
<h2 align="center">BOOK INFORMATION</h2>

<form method="post">
    <table border="1" align="center" cellpadding="5">
        <tr><td>Book No:</td><td><input type="number" name="book_no" required></td></tr>
        <tr><td>Title:</td><td><input type="text" name="title" required></td></tr>
        <tr><td>Edition:</td><td><input type="text" name="edition" required></td></tr>
        <tr><td>Publisher:</td><td><input type="text" name="publisher" required></td></tr>
        <tr><td colspan="2" align="center"><input type="submit" name="submit" value="Add Book"></td></tr>
    </table>
</form>

<br><hr><br>

<h3 align="center">All Book Details</h3>

<table border="1" align="center" cellpadding="5">
<tr><th>Book No</th><th>Title</th><th>Edition</th><th>Publisher</th></tr>

<?php
$result = $conn->query("SELECT * FROM book_details");
if ($result->num_rows > 0) {
    while ($r = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$r['Book_no']}</td>
                <td>{$r['Title']}</td>
                <td>{$r['Edition']}</td>
                <td>{$r['Publisher']}</td>
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
