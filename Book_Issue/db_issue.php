<?php 
    $conn = new mysqli("localhost", "root", "", "library_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $student_id = $_POST["student_id"];
    $book_id = $_POST["book_id"];
    $actual_return_date = $_POST["return_date"];
    $issue_date = date("Y-m-d");
    $status = "issued";

    $sql = "UPDATE transaction SET Status = '$status', Issue_Date = '$issue_date', Actual_Return_Date = '$actual_return_date' WHERE Student_Id = '$student_id' AND Book_Id = '$book_id' AND Status = 'reserved'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Book issued successfully.";
        
    } else {
        echo "Error issuing book: " . $conn->error;
    }

    $conn->close();
?>