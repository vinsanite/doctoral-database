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

$sql = "SELECT InstructorId, FName, LName, StartDate, Degree, Rank, Type FROM INSTRUCTOR";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' style='width:100%; text-align: left;'>
            <tr>
                <th>Instructor ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Start Date</th>
                <th>Degree</th>
                <th>Rank</th>
                <th>Type</th>
            </tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["InstructorId"]) . "</td>
                <td>" . htmlspecialchars($row["FName"]) . "</td>
                <td>" . htmlspecialchars($row["LName"]) . "</td>
                <td>" . htmlspecialchars($row["StartDate"]) . "</td>
                <td>" . htmlspecialchars($row["Degree"]) . "</td>
                <td>" . htmlspecialchars($row["Rank"]) . "</td>
                <td>" . htmlspecialchars($row["Type"]) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
