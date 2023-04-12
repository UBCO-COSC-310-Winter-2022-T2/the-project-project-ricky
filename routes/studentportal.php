<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/studentportal.css">
    <title>Student Portal</title>
</head>
<body>
    <div class="main-container">
        <div class="classes-nav">
            <a href="logout.php">Logout</a>
            <h1>Classes enrolled in</h1>
            <a href="classes.php" class="add-class-btn">+</a>
        </div>

        <?php
            include 'dbConnection.php';
            $username = $_SESSION['username'];
            $sql = "SELECT s.cname, teacher, s.school FROM sclass as s JOIN class as c ON s.cname=c.cname AND s.school=c.school WHERE s.username=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    echo "<a href='studentclass.php?username=" . urlencode($username) . "&cname=" . urlencode($row["cname"]) . "&school=" . urlencode($row["school"]) . "&teacher=" . urlencode($row["teacher"]) . "' class='class-card-link'>";
                    echo "<div class='class-card'>";
                    echo "<h2>" . htmlspecialchars($row["cname"]) . "</h2>";
                    echo "<p>School: " . htmlspecialchars($row["school"]) . "</p>";
                    echo "<p>Instructor: " . htmlspecialchars($row["teacher"]) . "</p>";
                    echo "</div>";
                    echo "</a>";
                }
            }else{
                echo "<p>No classes found. Click the + button to add some!</p>";
            }
            $stmt->close();
            $conn->close();
        ?>
    </div>
</body>
</html>