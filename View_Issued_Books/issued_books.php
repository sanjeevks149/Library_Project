<html>
    <head>
        <title>Issued Books</title>
        <link rel="stylesheet" href="style.css">
        <script>
            function sort() {
                var filter = document.querySelector('select[name="filter"]').value;
                fetch(`sort_book.php?filter=${filter}`)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('book-list').innerHTML = data;
                });
            }
            window.onload = sort;
        </script>
    </head>
    <body>
        <div class="header">
            <h1>My Issued Books</h1>
        <select name="filter"  onchange="sort()">
            <option value="all">All Books</option>
            <option value="reserved">Reserved Books</option>
            <option value="issued">Issued Books</option>
            <option value="returned">Returned Books</option>
        </select>
        </div>
        <div id ="book-list">
        </div>
    </body>
</html>