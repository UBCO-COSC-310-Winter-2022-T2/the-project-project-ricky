<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
            <!-- <link rel="stylesheet" href="css/all.css"> -->
            <!-- <link rel="stylesheet" href="css/classes.css"> -->
            <script src="scripts/login-validation.js"></script>
        </head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f2f2f2;
            }

            .main-container {
                width: 80%;
                margin: 0 auto;
                box-sizing: border-box;
                border: 1px solid #ccc;
                background-color: #fff;
                padding: 2em;
                border-radius: 8px;
            }

            .classes-nav {
                background-color: #73d0b9;
                display: flex;
                color: #fff;
                align-items: center;
                justify-content: center;
                height: 3em;
            }

            .classes-nav h1 {
                margin: 0;
            }

            .search-container {
                background-color: #99ddcc;
                display: flex;
                justify-content: center;
                align-items: center;
                position: relative;
                width: 100%;
                height: 4em;
                border: 1px solid #ccc;
                box-sizing: border-box;
            }

            input[type="text"] {
                width: 98%;
                box-sizing: border-box;
                font-size: 16px;
                border: 1px solid #ccc;
                border-radius: 4px;
                background-color: #f8f8f8;
                transition: all 0.3s;
                height: 2em;
                padding-left: 8px;
            }

            input[type="text"]:focus {
                background-color: white;
                border-color: blue;
            }

            .suggestions {
                background-color: white;
                border: 1px solid #ccc;
                border-radius: 4px;
                border-top: none;
                display: none;
                max-height: 200px;
                overflow-y: auto;
                position: absolute;
                left: 0;
                right: 0;
                width: 100%;
                box-sizing: border-box;
                z-index: 1;
            }

            .suggestion {
                cursor: pointer;
                padding: 5px;
            }

            .suggestion:hover {
                background-color: lightblue;
                color: white;
            }

            .class {
                background-color: #f8f8f8;
                border-radius: 8px;
                padding: 1em;
                margin-bottom: 1em;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
            }

            .class h2 {
                margin-top: 0;
            }

            .author, .teacher {
                font-style: italic;
                margin-bottom: 0.5em;
            }

            .create {
                display: inline-block;
                padding: 1em;
                background-color: #73d0b9;
                border-radius: 8px;
                text-align: center;
                transition: background-color 0.3s;
                color: #fff;
                text-decoration: none;
            }

            .create:hover {
                background-color: #62c0a9;
            }

            input[type="submit"] {
                background-color: #73d0b9;
                border: none;
                color: #fff;
                cursor: pointer;
                font-size: 16px;
                padding: 5px;
                transition: background-color 0.3s, border-color 0.3s, color 0.3s;
                border-radius: 4px;
            }

            input[type="submit"]:hover {
                background-color: #62c0a9;
            }


        </style>
    <body>
        
        <?php include('headers/header.php'); ?>
    
        <form method="post" action="">
            <input type="text" name="search" placeholder="Search">
            <input type="submit" value="Search">
        </form>
        <?php
            include("dbConnection.php");

            // search input
            $username = $_SESSION['username'];

            $cname = "";
            if (isset($_POST['search'])) {
                $cname = $_POST['search'];
            }
            
            $stmt = $conn->prepare("SELECT * FROM class WHERE teacher LIKE '%$username%' AND cname LIKE '%$cname%'"); 
            if ($stmt->execute()) {
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    $className = $row['cname'];
                    $school = $row['school'];
                    echo "<br>";
                    echo "<div class='class'>";
                    echo("<a href='class.php?cname=".$className."&school=".$school."'><h2>".$className."</h2></a>");
                    echo("<p class='author' >School: ".$school."</p>");
                    echo "<p class='teacher' >Teacher: ".$username."</p>";
                    echo '</div>';
                }
            } else {
                echo "Error: " . $stmt->error;
            }
            echo "<a class='create' href='createClass.php'><h2>Create a class</h2></a>";
            $conn->close();
        ?>
    </body>
</html>
