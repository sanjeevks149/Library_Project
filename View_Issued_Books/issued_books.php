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
<select name="filter"  onchange="sort()">
    <option value="all">All Books</option>
    <option value="reserved">Reserved Books</option>
    <option value="issued">Issued Books</option>
    <option value="returned">Returned Books</option>
</select>
<div id ="book-list">
</div>
