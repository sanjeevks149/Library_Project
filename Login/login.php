<?php
session_start();
$conn = new mysqli("localhost","root","","library_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$email = $_POST['email'];
$password = $_POST['password'];
$username = $_POST['email']; // Assuming username is the same as email

   
$sql = "SELECT * FROM user WHERE Email='$email' AND Password='$password' OR Name='$username' AND Password='$password'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if($row['Email'] == $email && $row['Password'] == $password || $row['Name'] == $username && $row['Password'] == $password) {
        $_SESSION['user_id'] = $row['Id'];
        header('location:../search_book/display.php');
    } else {
        echo "Invalid email or password.";
    }
} else {
    echo "Invalid email or password.";
}   
?>