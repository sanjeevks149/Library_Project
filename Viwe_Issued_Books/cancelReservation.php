
<?php
    $conn = new mysqli("localhost", "root", "", "library_db");
    if ($conn->connect_error) {
        die("". $conn->connect_error);
    }
    session_start();
    if (isset($_SESSION['user_id']) ) {
        $student_id = $_SESSION['user_id'];
    }else {
        header('location:../Login/login.html');
        exit();
    }
    if (isset($_GET['transaction_id'])) {
        $transaction_id = $_GET['transaction_id'];
        $sql = "DELETE FROM transaction WHERE Transaction_Id = '$transaction_id' AND Student_Id = '$student_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Reservation cancelled successfully.";
        } else {
            echo "Error cancelling reservation: " . $conn->error;
        }
    }
    $conn->close();
?>