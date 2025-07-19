<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Book</title>
</head>
<body>
    <h1>Delete Book</h1>
    <?php
        $conn = new mysqli("localhost", "root", "", "library_db");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $id = $_GET['id'];

        $sql = "DELETE FROM book WHERE Book_Id='$id'";
        
        if ($conn->query($sql) === TRUE) {
            echo "Book deleted successfully.";
        } else {
            echo "Error deleting book: " . $conn->error;
        }

        $conn->close();
    ?>
</body>
</html>