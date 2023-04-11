<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/studentClasses.css">
    <title>Student Classes</title>
    <script>
        function confirmClass(username, cname, school) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'confirmClass.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    window.location.href = 'studentportal.php';
                }
            };
            xhr.send(`username=${encodeURIComponent(username)}&cname=${encodeURIComponent(cname)}&school=${encodeURIComponent(school)}`);
        }
    </script>
</head>
<body>
    <div class="main-container">
        <div class="classes-nav">
            <h1>Confirm Class</h1>
        </div>
        <div class="classes-container">
            <?php
                if($_SERVER['REQUEST_METHOD']=='POST' and isset($_POST['cname'])){
                    $cname = $_POST['cname'];
                    $school = $_POST['school'];
                    
                    include 'dbConnection.php';
                    $username = $_SESSION['username'];

                    $sql = "SELECT school, cname, teacher FROM class WHERE cname = ? AND school = ?"; // Update the query as needed
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $cname, $school);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='class-card'>";
                            echo "<h2>Institution: " . htmlspecialchars($row["school"]) . "</h2>";
                            echo "<h3>Course Name: " . htmlspecialchars($row["cname"]) . "</h3>";
                            echo "<p>Instructor: " . htmlspecialchars($row["teacher"]) . "</p>";
                            echo "<button onclick='confirmClass(\"" . htmlspecialchars($username) . "\", \"" . htmlspecialchars($row["cname"]) . "\", \"" . htmlspecialchars($row["school"]) . "\")'>Confirm</button>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No classes found.</p>";
                    }

                $conn->close();
            }
            ?>
        </div>
    </div>
</body>
</html>
