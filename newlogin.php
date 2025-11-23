<?php
$conn = new mysqli("localhost", "rinshad", "rinshadwebsql", "rinshad");
if ($conn->connect_error) die("Database connection failed");

if (!empty($_POST['submit'])) {

    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Check username
    $u = $conn->query("SELECT * FROM users WHERE username='$user'");

    if ($u->num_rows > 0) {               // Username exists
        $row = $u->fetch_assoc();

        if ($row['password'] == $pass) {  // Password correct
            header("Location: newwelcome.php?user=" . urlencode($user));
            exit;
        } 
        else {                             // Username correct, password wrong
            echo "<p align='center' style='color:red;'>Incorrect Password</p>";
        }

    } else {   // Username does NOT exist

        // Check if password exists in any account
        $p = $conn->query("SELECT * FROM users WHERE password='$pass'");

        if ($p->num_rows > 0) {
            echo "<p align='center' style='color:red;'>Incorrect Username</p>";
        } else {
            echo "<p align='center' style='color:red;'>Invalid Username and Password</p>";
        }
    }
}

$conn->close();
?>
<html>
<head><title>Login Page</title></head>
<body>
<h2 align="center">LOGIN PAGE</h2>

<form method="post">
<table border="1" align="center" cellpadding="5">
<tr>
    <td>Username:</td>
    <td><input type="text" name="username" required></td>
</tr>
<tr>
    <td>Password:</td>
    <td><input type="password" name="password" required></td>
</tr>
<tr>
    <td colspan="2" align="center">
        <input type="submit" name="submit" value="Login">
    </td>
</tr>
</table>
</form>

</body>
</html>
