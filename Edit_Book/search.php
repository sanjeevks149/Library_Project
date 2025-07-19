<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Books</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
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
                echo "<button onclick='location.href=\"edit.php?id={$row['Book_Id']}\"'>Edit</button>";
                echo "<button onclick='location.href=\"delete_book.php?id={$row['Book_Id']}\"'>Delete</button>";
                echo "</div></a>";
            
            }
        }
        else {
            echo "<p>No search term provided.</p>";
        }
    $conn->close();
?>
    
</body>
