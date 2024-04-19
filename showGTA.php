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

$sql = "SELECT SectionID, MonthlyPay, Department, StudentId FROM GTA";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' style='width:100%; text-align: left;'>
            <tr>
                <th>Section ID</th>
                <th>Monthly Payment</th>
                <th>Department</th>
                <th>Student ID</th>
            </tr>";
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["SectionID"]) . "</td>
                <td>$" . number_format($row["MonthlyPay"], 2) . "</td>
                <td>" . htmlspecialchars($row["Department"]) . "</td>
                <td>" . htmlspecialchars($row["StudentId"]) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
