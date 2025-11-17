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
    $emp_id = $_POST['emp_id'];
    $emp_name = $_POST['emp_name'];
    $designation = $_POST['designation'];
    $salary = $_POST['salary'];

    // Insert record
    $sql = "INSERT INTO employee_details (Emp_id, Emp_name, Designation, Salary)
            VALUES ('$emp_id', '$emp_name', '$designation', '$salary')";

    if ($conn->query($sql)) {
        echo "<p style='color:green;' align='center'>
                ✅ Employee added successfully!<br>
                👤 Employee ID: <b>$emp_id</b>
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
    <title>Employee Information</title>
</head>
<body>
    <h2 align="center">EMPLOYEE INFORMATION</h2>

    <!-- Form to Add Employee -->
    <form method="post" action="">
        <table border="1" align="center" cellpadding="5" cellspacing="0">
            <tr>
                <td>Employee ID:</td>
                <td><input type="number" name="emp_id" required></td>
            </tr>
            <tr>
                <td>Employee Name:</td>
                <td><input type="text" name="emp_name" required></td>
            </tr>
            <tr>
                <td>Designation:</td>
                <td><input type="text" name="designation" required></td>
            </tr>
            <tr>
                <td>Salary:</td>
                <td><input type="number" name="salary" required></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="submit" value="Add Employee">
                </td>
            </tr>
        </table>
    </form>

    <br><hr><br>

    <!-- Display All Employees -->
    <h3 align="center">All Employee Details</h3>

    <table border="1" align="center" cellpadding="5" cellspacing="0">
        <tr style="background-color:lightgray;">
            <th>Employee ID</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Salary</th>
        </tr>

        <?php
        // Fetch and display all employee records
        $result = $conn->query("SELECT * FROM employee_details");

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Emp_id']}</td>
                        <td>{$row['Emp_name']}</td>
                        <td>{$row['Designation']}</td>
                        <td>{$row['Salary']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4' align='center'>No employees found</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
