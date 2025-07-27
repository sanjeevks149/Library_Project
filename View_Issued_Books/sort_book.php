
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
    $filter = $_GET['filter'] ?? 'all';
    if($filter == 'reserved') {
        $sql = "SELECT * FROM book WHERE Book_Id IN (SELECT Book_Id FROM transaction WHERE Student_Id = '$student_id' AND Status = 'reserved')";
    } elseif($filter == 'issued') {
        $sql = "SELECT * FROM book WHERE Book_Id IN (SELECT Book_Id FROM transaction WHERE Student_Id = '$student_id' AND Status = 'issued')";
    } elseif($filter == 'returned') {
        $sql = "SELECT * FROM book WHERE Book_Id IN (SELECT Book_Id FROM transaction WHERE Student_Id = '$student_id' AND Status = 'returned')";
    } elseif($filter == 'all') {
        $sql = "SELECT * FROM book WHERE Book_Id IN (SELECT Book_Id FROM transaction WHERE Student_Id = '$student_id')";
    }

    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<div class ='book-item'>";
        echo "<img src='../Book/{$row['Book_Cover']}' style='width:200px; margin:10px;'> ";
        echo "<p>Title: ". $row["Book_Name"] ."</p>";
        echo "<p>Available: ". ($row["Book_Available"] ? "Yes" : "No") ."</p>";
        $sql2 = "SELECT * FROM transaction WHERE Student_Id = '$student_id' AND Book_Id = '{$row['Book_Id']}' ";
        $result1 = $conn->query($sql2);
        
        $row1 = $result1->fetch_assoc();
        if($result1->num_rows == 2) {
            $sql3 = "DELETE FROM transaction WHERE Student_Id = '$student_id' AND Book_Id = '{$row['Book_Id']}' AND Status = 'returned'";
            $conn->query($sql3);
        }
        if($row1['Status']=='reserved'){
            echo "<p>Status: Reserved</p>";
            echo "<button onclick=\"location.href='cancelReservation.php?transaction_id={$row1['Transaction_Id']}'\">Cancel Reservation</button>";
        }
        else{
            echo "Status: $row1[Status]";
        }
        echo "</div>";
    }
    $conn->close();
?>
