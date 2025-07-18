<?php 
    $conn = mysqli_connect("localhost", "root", "", "library_db");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }   
    $filename = $_FILES['cover']['name'];
    $target_file = "uploads/".$filename;
    $title = $_POST['title'];
    $author = $_POST['author']; 
    $book_available = $_POST['book_available'];

    $sql = "UPDATE books SET title='$title', author='$author', cover='$target_file', available='$book_available' WHERE id=" . $_POST['id'];
    if (mysqli_query($conn, $sql)) {
        if (move_uploaded_file($_FILES['cover']['tmp_name'], $target_file)) {
            echo "Book updated successfully.";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Error updating book: " . mysqli_error($conn);
    }
    mysqli_close($conn);
?>