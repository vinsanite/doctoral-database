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

$sql = "SELECT StudentId, FName, LName, StSem, StYear, Supervisor FROM PHDSTUDENT";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' style='width:100%; text-align: left;'>
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Starting Semester</th>
                <th>Starting Year</th>
                <th>Supervisor</th>
            </tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["StudentId"]) . "</td>
                <td>" . htmlspecialchars($row["FName"]) . "</td>
                <td>" . htmlspecialchars($row["LName"]) . "</td>
                <td>" . htmlspecialchars($row["StSem"]) . "</td>
                <td>" . htmlspecialchars($row["StYear"]) . "</td>
                <td>" . htmlspecialchars($row["Supervisor"]) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
