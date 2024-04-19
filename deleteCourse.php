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

    $courseID = $_POST['CourseID'] ?? "";

    if ($courseID != "") {
        $stmt = $conn-> prepare("DELETE FROM COURSE WHERE CourseID = ?");
        $stmt->bind_param("s", $courseID);

        if ($stmt->execute()) {
            echo "Course deleted successfully";
        } else {
            echo "Error deleting course: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Course ID is required";
    }
}

$conn->close();
?>
