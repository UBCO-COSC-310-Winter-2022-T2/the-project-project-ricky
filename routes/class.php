<?php

start_session();
include('dbConnection');

//$cname = $_SESSION['cname'];
//$school = $_SESSION['school'];
$cname = "Test Class";
$school = "UBC";
// Fetch students
$students_query = "SELECT student.firstName, student.lastName, sclass.grade FROM student INNER JOIN sclass ON student.username = sclass.username WHERE cname = ? and school = ?";
$stmt->bind_param("ss", $cname, $school); 
$students_result = $conn->query($students_query);

// Fetch quizzes
$quizzes_query = "SELECT * FROM quiz WHERE cname = ? and school = ?"; 
$stmt->bind_param("ss", $cname, $school); 
$quizzes_result = $conn->query($quizzes_query);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class View</title>
    <script>
        function showForm() {
            const form = document.getElementById("newQuizForm");
            form.style.display = "block";
        }

        function hideForm() {
            const form = document.getElementById("newQuizForm");
            form.style.display = "none";
        }
    </script>
</head>
<body>
    <h1><?= $school: $cname?></h1>
    <h2>Students</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Grade</th>
        </tr>
        <?php while ($row = $students_result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['firstName'] $row['lastName']?></td>
            <td><?= $row['grade'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Quizzes</h2>
    <ul>
        <?php while ($row = $quizzes_result->fetch_assoc()): ?>
        <li>
            <?= $row['qname'] ?>
            <button>Edit Quiz</button>
        </li>
        <?php endwhile; ?>
    </ul>
    <button onclick="showForm()">New Quiz</button>

    <form id="newQuizForm" style="display:none;" action="initializeQuiz.php" method="post">
        <h2>New Quiz</h2>
        <label for="quizName">Quiz Name:</label>
        <input type="text" name="qname" id="quizName" required>
        <br>
        <input type="submit" value="Submit">
        <button type="button" onclick="hideForm()">Cancel</button>
    </form>
</body>
</html>
