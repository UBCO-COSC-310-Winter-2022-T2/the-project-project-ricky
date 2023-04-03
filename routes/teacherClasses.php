<!DOCTYPE html>
<html>
    <body>
        <head>
            <link rel="stylesheet" href="css/all.css">
            <link rel="stylesheet" href="css/classes.css">
            <script src="scripts/login-validation.js"></script>
        </head>
        <?php include('headers/header.php'); ?>
    <main>
        <form method="post" action="">
            <input type="text" name="search" placeholder="Search">
            <input type="submit" value="Search">
        </form>
        <?php
            session_start();
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
        </main>
    </body>
</html>
