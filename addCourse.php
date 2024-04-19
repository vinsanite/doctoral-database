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

    $courseID = $_POST['CourseID'] ?? "";
    $cname = $_POST['CName'] ?? "";

    //validate input 
    if (!empty($courseID) && !empty($cname)) {
        $stmt = $conn->prepare("INSERT INTO Course (CourseID, CName) VALUES (?, ?)");
        $stmt->bind_param("ss", $courseID, $cname);

        if ($stmt->execute()){
            echo "New record created successfully";
        } else {
            echo "Error adding course" . $conn->error;
        }
        $stmt->close();
    } else {
        echo "Please fill in all fields";
    }
        
}

$conn->close();

?>

<!-- Link back to the main form -->
<a href="index.hmtl">Back to main Page</a>