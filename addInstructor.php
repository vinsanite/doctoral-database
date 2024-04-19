<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'doctoral';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $instructorId = $_POST['InstructorId'];
    $fname = $_POST['FName'];
    $lname = $_POST['LName'];
    $startDate = $_POST['StartDate'];
    $degree = $_POST['Degree'];
    $rank = $_POST['Rank'];
    $type = $_POST['Type'];

    //validate input
    if (!empty($instructorId) && !empty($fname) && !empty($lname) && !empty($startDate) && !empty($degree) && !empty($rank) && !empty($type)) {

        $stmt = $conn->prepare("INSERT INTO INSTRUCTOR (InstructorId, FName, LName, StartDate, Degree, Rank, Type) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $instructorId, $fname, $lname, $startDate, $degree, $rank, $type);

        if ($stmt->execute()) {
            echo "New instructor added successfully";
        } else {
            echo "Error adding course" . $stmt->error;
        }
        $stmt->close();

    } else {    
        echo "Please fill in all fields";
    }
    
    
}
$conn->close();
?>
