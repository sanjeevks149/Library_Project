<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('location:../Login/login.php');
    
    exit();
}
$user_id = $_SESSION['user_id'];
$book_id = $_GET['book_id'];
$conn = new mysqli("localhost", "root", "", "library_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "insert into transaction (Student_Id, Book_Id, Status) values($user_id, $book_id, 'reserved')";
if ($conn->query($sql) === TRUE) {
    echo "Book reserved successfully.";
} else {
    echo "Error reserving book: " . $conn->error;
}