<?php 
    $conn = mysqli_connect("localhost", "root", "", "library_db");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }   
    $id = $_POST['id'];
    $filename = $_FILES['book_cover']['name'];
    $target_file = "../Book/uploads/".$filename;
    $title = $_POST['title'];
    $author = $_POST['author']; 
    $book_available = $_POST['book_available'];

    $sql = "UPDATE book SET Book_Name='$title', Author='$author', Book_Cover='$target_file', Book_Available='$book_available' WHERE Book_Id='$id'";
    if (mysqli_query($conn, $sql)) {
        if (move_uploaded_file($_FILES['book_cover']['tmp_name'], $target_file)) {
            echo "Book updated successfully.";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "Error updating book: " . mysqli_error($conn);
    }
    mysqli_close($conn);
?>