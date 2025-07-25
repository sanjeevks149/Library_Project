<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="header">
            <form method="post" action="search.php">
                <input type="text" name="search" placeholder="Search for books...">
                <input type="submit" value="Search">
            </form>
        </div>
        <div class="book-list">
            <?php
            $conn = new mysqli("localhost", "root", "", "library_db");
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $result = $conn->query("SELECT * FROM book WHERE Book_Cover IS NOT NULL");

            while ($row = $result->fetch_assoc()) {
                echo "<div class ='book-item' onclick='location.href=\"book_details.php?id={$row['Book_Id']}\"'>";
                echo "<img src='../Book/{$row['Book_Cover']}' style='width:200px; margin:10px;'> ";
                echo "<p>Title: ". $row["Book_Name"] ."</p>";
                echo "<p>Author: ". $row["Author"] ."</p>";
                echo "<p>Available: ". ($row["Book_Available"] ? "Yes" : "No") ."</p>";
                echo "</div>";
            }
            $conn->close();
            ?>
        </div>
    </body>
</html>