<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "employeeDB";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Attendance";
$result = $conn->query($sql);

echo "<h2>Attendance Records</h2>";
echo "<table border='1'><tr><th>ID</th><th>Employee ID</th><th>Date</th><th>Check-In</th><th>Check-Out</th><th>Status</th></tr>";

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['AttendanceID']}</td>
                <td>{$row['EmployeeID']}</td>
                <td>{$row['Date']}</td>
                <td>{$row['CheckIn']}</td>
                <td>{$row['CheckOut']}</td>
                <td>{$row['Status']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No records found</td></tr>";
}

echo "</table>";

$conn->close();
?>
