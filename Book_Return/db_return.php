<?php 
    $conn = new mysqli("localhost", "root", "", "library_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $student_id = $_POST["student_id"];
    $book_id = $_POST["book_id"];
    $return_date = new DateTime();
    $status = "returned";

    $sql1 = "SELECT Actual_Return_Date FROM transaction WHERE Student_Id = '$student_id' AND Book_Id = '$book_id' AND Status = 'issued'";
    $sql2 = "UPDATE book SET Book_Available = Book_Available + 1 WHERE Book_Id = '$book_id'";
    $actual_return_date = $conn->query($sql1);
    if ($actual_return_date->num_rows > 0) {
        $row = $actual_return_date->fetch_assoc();
        $actual_return_date = new DateTime($row['Actual_Return_Date']);
        $interval = $actual_return_date->diff($return_date);
        $days = $interval->days;
        $fine = $days > 0 ? $days * 10 : 0;
        if( $actual_return_date <$return_date) {
            echo "⏳ $days days have <b>passed</b> since the actual return date. <br>";
            echo "📅 A fine of $fine has been applied for late return.";
        } else {
            echo "🎉 The book was returned on time.";
            echo "No fine applied.";
        }
        $return_date = $return_date->format('Y-m-d');
        $sql = "UPDATE transaction SET Status = '$status', Return_Date = '$return_date', Fine = '$fine' WHERE Student_Id = '$student_id' AND Book_Id = '$book_id' AND Status = 'issued'";
        if ($conn->query($sql) === TRUE) {
            echo "<br>Book returned successfully.";
            $conn->query($sql2);
        } else {
            echo "Error returning book: " . $conn->error;
        }
    } else {
        echo "No record found for the specified book and student.";
        exit;
    }
    $conn->close();
?>