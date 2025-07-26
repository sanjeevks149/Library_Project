<?php 
    $conn = new mysqli("localhost", "root", "", "library_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }   
    $student_id = $_POST['student_id'];


    $sql1 = "SELECT Book_Id,Book_Name FROM book WHERE Book_Id IN (SELECT Book_Id FROM transaction WHERE Student_Id = '$student_id' AND Status = 'issued')";
    $result1 = $conn->query($sql1);
    if ($result1->num_rows > 0) {?>
        <form action="db_return.php" method="post">
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
            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
            <input type="submit" value="Return Book">
        </form>
    <?php } else {
        echo "No issued books available for this student.";
    }  
?>