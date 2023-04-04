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
            <h1>Add a Class</1>
        </div>
            <?php
            if($_SERVER["REQUEST_METHOD"]=='POST' and isset($_POST['school'])){
                echo"<form action='studentClasses.php' method='POST'>";
                echo"<div class='search-container'>";
                echo"<input type='text' id='search' name='cname' placeholder='Search for your class' onkeyup='showSuggestions2(this.value)'>";
                echo "<input type='hidden' id='hidden-school' name='school' value='". htmlspecialchars($_POST['school']) ."'>";
                echo "</div>";
                echo "<div id='suggestions2' class='suggestions'></div>";
                echo "</form>";
            }else{
                echo "<form action='classes.php' method='POST'>";
                echo "<div class='search-container'>";
                echo "<input type='text' id='search' name='school' placeholder='Search for your school' onkeyup='showSuggestions(this.value)'>";
                echo "</div>";
                echo "<div id='suggestions' class='suggestions'></div>";
                echo "</form>";
            }
            // <div class="search-container">
            //     <input type="text" id="search" name="school" placeholder="Search for your school" onkeyup="showSuggestions(this.value)">
            // </div>
            // <div id="suggestions" class="suggestions"></div>
            ?>
    </div>
</form>
</body>
</html>