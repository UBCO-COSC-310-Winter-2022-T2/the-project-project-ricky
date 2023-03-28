<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../scripts/classes.js"></script>
    <link rel="stylesheet" href="../css/classes.css">
    <title>School Search</title>
</head>
<body>
    <div class="main-container">
        <div class="classes-nav">
            <h1>Menu</h1>
            <h1>Courses</1>
        </div>
        <form action='classes.php' method='POST'>
            <div class="search-container">
                <input type="text" id="search" name="search" onkeyup="showSuggestions(this.value)">
                <div id="suggestions" class="suggestions"></div>
            </div>
    </div>
</form>
</body>
</html>