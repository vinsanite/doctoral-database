<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'doctoral';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST['StudentId'];

    // Check if the student has passed any milestones
    $result = $conn->query("SELECT * FROM MILESTONESPASSED WHERE StudentId = '$studentId'");
    if ($result->num_rows == 0) {
        // If no milestones passed, delete from GRA and PHDSTUDENT tables
        $conn->query("DELETE FROM SELFSUPPORT WHERE StudentId = '$studentId'");
        $conn->query("DELETE FROM PHDCOMMITTEE WHERE StudentId = '$studentId'");
        $conn->query("DELETE FROM GRA WHERE StudentId = '$studentId'");
        $conn->query("DELETE FROM PHDSTUDENT WHERE StudentId = '$studentId'");


        echo "GRA student deleted successfully.";
    } else {
        echo "Cannot delete GRA student; milestones were passed.";
    }
}
$conn->close();
?>
