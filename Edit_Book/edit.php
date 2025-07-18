<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
</head>
<body>
    <h1>Edit Book</h1>
    <form method="post" action="update_book.php">
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>
        <br>
        <label for="cover">Cover Image:</label>
        <input type="file" id="cover" name="cover">
        <br>
        <label for="available">Book Available:</label>
        <input type="number" id="available" name="available" value="1">
        <br>
        <input type="submit" value="Update Book">
    </form>
</body>
</html>