<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "EmployeeDB"; 


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$employee_id = $_POST['employee_id'];
$date = $_POST['date'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$status = $_POST['status'];


$sql = "INSERT INTO Attendance (EmployeeID, Date, CheckIn, CheckOut, Status) 
        VALUES ('$employee_id', '$date', '$checkin', '$checkout', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "Attendance recorded successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
