<link rel="stylesheet" href="style2.css">
<?php 
    $conn = new mysqli("localhost", "root", "", "library_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }   
    $student_id = $_POST['student_id'];


    $sql1 = "SELECT Book_Id,Book_Name FROM book WHERE Book_Id IN (SELECT Book_Id FROM transaction WHERE Student_Id = '$student_id' AND Status = 'reserved' AND Book_Available > 0)";

    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {?>
        <form action="db_issue.php" method="post">
            <p>Student ID: <?php echo $student_id;?></p>
            <label for="book_id">Book ID:</label>
            <select name="book_id" id="book_id">
                <?php
                while ($row = $result1->fetch_assoc()) {
                    echo "<option value='" . $row['Book_Id'] . "'>" . $row['Book_Name'] . "</option>";
                }
                ?>
            </select>
            <br>
            <label for="return_date">Return Date:</label>
            <input type="date" name="return_date" id="return_date" required><br>
            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
            <input type="submit" value="Issue Book">
        </form>
    <?php } else {
        echo "No reserved books available for this student.";
    }  
?>