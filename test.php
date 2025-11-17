<?php
$conn = new mysqli("localhost", "rinshad", "rinshadwebsql", "rinshad");

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
} else {
    echo "✅ Connected successfully!";
}
?>

