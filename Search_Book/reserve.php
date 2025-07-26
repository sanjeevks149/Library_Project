<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:../Login/login.html');
    
    exit();
}
$user_id = $_SESSION['user_id'];
$book_id = $_GET['book_id'];
$conn = new mysqli("localhost", "root", "", "library_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "insert into transaction (Student_Id, Book_Id, Status) values($user_id, $book_id, 'reserved')";
$sql2 = "Select Student_Id, Book_Id, Status from transaction where Student_Id = $user_id and Book_Id = $book_id";
if ($conn->query($sql2)->num_rows > 0) {
    echo "You have already reserved this book.";
    exit();
}
else{
    if ($conn->query($sql) === TRUE) {
        echo "Book reserved successfully.";
    }else {
        echo "Error reserving book: " . $conn->error;
    }
}
