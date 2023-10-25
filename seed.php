<?php
$servername = 'localhost';  // Change this if your database is hosted on a different server
$username = 'root';
$password = '';
$database = 'arduino';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the table
$sql = "SELECT * FROM temp";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table >";
    echo "<tr><th>ID</th><th>Temp</th><th>Humidity</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["temp"] . "</td>";
        echo "<td>" . $row["humidity"] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "No results found.";
}

$conn->close();  // Close the connection
?>
