<?php
    $conn = new mysqli("localhost", "root", "", "library_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $book_id = $_GET['id'];
    $sql = "SELECT * FROM book WHERE Book_Id = $book_id";
    $result = $conn->query($sql);
    $book = $result->fetch_assoc();
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="book-details">
            <h1><?php echo $book['Book_Name']; ?></h1>
            <img src="../Book/<?php echo $book['Book_Cover']; ?>" alt="<?php echo $book['Book_Name']; ?>">
            <p><strong>Author:</strong> <?php echo $book['Author']; ?></p>
            <p><strong>Available:</strong> <?php echo $book['Book_Available'] ? "Yes" : "No"; ?></p>
        </div>
    </body>
</html>

<?php
    $conn->close();
?> 