<?php
    $conn = new mysqli("localhost", "root", "", "library_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $search = $_POST['search'];

    if($search){
        $sql = "SELECT * FROM book WHERE Book_Name LIKE '%$search%' OR Author LIKE '%$search%'";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<div class ='book-item'>";
            echo "<img src='../Book/{$row['Book_Cover']}' style='width:200px; margin:10px;'> ";
            echo "<p>Title: ". $row["Book_Name"] ."</p>";
            echo "<p>Author: ". $row["Author"] ."</p>";
            echo "<p>Available: ". ($row["Book_Available"] ? "Yes" : "No") ."</p>";
            echo "</div>";
        }
    }