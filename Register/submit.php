<?php
$conn = new mysqli("localhost","root","","library_db");
if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$sql = "INSERT INTO user(Id,Name,Email,Password) VALUES (NULL,'$name', '$email', '$password')";
if($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>