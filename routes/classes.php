<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../scripts/classes.js"></script>
</head>
<?php include 'headers/header.php'; ?>
<body>
    <div class="classes-nav">
        <h1>Menu</h1>
        <h1>Courses</1>
    </div>
    <form action='classes.php' method='POST'>
        <label for="search">Search schools:</label>
        <input type="text" id="search" name="search" onkeyup="showSuggestions(this.value)">
        <div id="suggestions" class="suggestions"></div>
</form>
</body>
</html>