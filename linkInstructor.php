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
    // Validate input
    if (!empty($_POST['InstructorId']) && !empty($_POST['CourseId']) && !empty($_POST['StudentId'])) {
        $instructorId = $_POST['InstructorId'];
        $courseId = $_POST['CourseId'];
        $studentId = $_POST['StudentId'];

        // Link to course
        $stmt = $conn->prepare("INSERT INTO COURSESTAUGHT (CourseID, InstructorId) VALUES (?, ?)");
        $stmt->bind_param("ss", $courseId, $instructorId);
        if ($stmt->execute()) {
            echo "Instructor linked to course successfully. ";
        } else {
            echo "Error linking instructor to course: " . $stmt->error;
        }
        $stmt->close();

        // Add to committee
        $stmt = $conn->prepare("INSERT INTO PHDCOMMITTEE (StudentId, InstructorId) VALUES (?, ?)");
        $stmt->bind_param("ss", $studentId, $instructorId);
        if ($stmt->execute()) {
            echo "Instructor added to committee successfully.";
        } else {
            echo "Error adding instructor to committee: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Please fill in all fields.";
    }
}
$conn->close();
?>
