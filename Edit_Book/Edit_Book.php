<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
    <body>
        <h1>Edit Book</h1>
        <div class="header">
            <form method="post" action="search.php">
                <input type="text" name="search" placeholder="Search for books...">
                <input type="submit" value="Search">
            </form>
        </div>
        <div class="book-list">
            <?php
            $conn = new mysqli("localhost", "root", "", "library_db");

            $result = $conn->query("SELECT * FROM book WHERE Book_Cover IS NOT NULL");


            while ($row = $result->fetch_assoc()) {
                echo "<div class ='book-item'>";
                echo "<img src='../Book/{$row['Book_Cover']}' style='width:200px; margin:10px;'> ";
                echo "<p>Title: ". $row["Book_Name"] ."</p>";
                echo "<p>Author: ". $row["Author"] ."</p>";
                echo "<p>Available: ". ($row["Book_Available"] ? "Yes" : "No") ."</p>";
                echo "<button onclick='location.href=\"edit.php?id={$row['Book_Id']}\"'>Edit</button>";
                echo "<button onclick='location.href=\"delete_book.php?id={$row['Book_Id']}\"'>Delete</button>";
                echo "</div>";
            }
            $conn->close();
            ?>
        </div>
    </body>
</html>