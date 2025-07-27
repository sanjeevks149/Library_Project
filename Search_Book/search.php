<!DOCTYPE html>
    <head>
        <title>Search Books</title>
        <link rel="stylesheet" type="text/css" href="style1.css">
    </head>
    <body>
        <div class="header">
            <form method="post" action="search.php">
                <input type="text" name="search" placeholder="Search for books...">
                <input type="submit" value="Search">
            </form>
            <button onclick="location.href='../View_Issued_Books/issued_books.php'">My Books</button>
        </div>
        <div class="book-list">
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
                        echo "<div class ='book-item' onclick='location.href=\"book_details.php?id={$row['Book_Id']}\"'>";
                        echo "<img src='../Book/{$row['Book_Cover']}' alt='Book Cover'> ";
                        echo "<p>Title: ". $row["Book_Name"] ."</p>";
                        echo "<p>Author: ". $row["Author"] ."</p>";
                        echo "<p>Available: ". ($row["Book_Available"] ? "Yes" : "No") ."</p>";
                        echo "</div>";
                    }
                }
                $conn->close();
            ?>
        </div>
   </body>
</html>