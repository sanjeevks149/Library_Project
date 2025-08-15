<?php
$conn = new mysqli("localhost","root","","library_db");
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = 'user'; // Default role for new users
$sql = "INSERT INTO user(Id,Name,Email,Password,Role) VALUES (NULL,'$name', '$email', '$password', '$role')";
if($conn->query($sql) === TRUE) {
    echo "<script>alert('Registration successful!');</script>";
    echo "<script>window.location.href='../Login/login.html';</script>";
    exit();
} else {
    echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    echo "<script>window.location.href='register.html';</script>";
}
$conn->close();
?>