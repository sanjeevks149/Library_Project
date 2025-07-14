<?php
    $conn = mysqli_connect("localhost", "root", "", "library_db");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if(!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

    $filename = $_FILES['book_cover']['name'];
    $target_file = "uploads/".$filename;
    $title = $_POST['title'];
    $author = $_POST['author'];
    $book_available = $_POST['book_available'];

    if (move_uploaded_file($_FILES["book_cover"]["tmp_name"], $target_file)) {
        // Save file name to DB
        echo "✅ Image uploaded successfully.<br>";
        echo '<a href="display.php">View Uploaded Images</a>';
    } else {
        echo "❌ Upload failed.";
    }

    $sql = "INSERT INTO book(Book_Id,Book_Name,Author, Book_Cover, Book_Available) VALUES (NULL,'$title', '$author', '$target_file', '$book_available')";
    if (mysqli_query($conn, $sql)) {
        echo "New book added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    // Close the connection
    $conn->close();


    
?>