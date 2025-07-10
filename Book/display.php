<?php
$conn = new mysqli("localhost", "root", "", "library_db");

$result = $conn->query("SELECT * FROM book WHERE Book_Cover IS NOT NULL");

echo "<h2>Uploaded Images:</h2>";

while ($row = $result->fetch_assoc()) {
    echo "<img src='uploads/{$row['Book_Cover']}' style='width:200px; margin:10px;'> ";
}

$conn->close();
?>
