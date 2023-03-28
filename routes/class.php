<?php
// Database configuration
$db_host = "localhost";
$db_username = "your_username";
$db_password = "your_password";
$db_name = "your_database_name";

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch students
$students_query = "SELECT student.name, sclass.grade FROM student INNER JOIN sclass ON student.username = sclass.username";
$students_result = $conn->query($students_query);

// Fetch quizzes
$quizzes_query = "SELECT * FROM quiz WHERE class_id = your_class_id"; // Replace your_class_id with the actual class id
$quizzes_result = $conn->query($quizzes_query);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class View</title>
    <style>
        /* Add your preferred styling here */
    </style>
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
    <h1>Students</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Grade</th>
        </tr>
        <?php while ($row = $students_result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['grade'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h1>Quizzes</h1>
    <ul>
        <?php while ($row = $quizzes_result->fetch_assoc()): ?>
        <li>
            <?= $row['name'] ?>
            <button>Edit Quiz</button>
        </li>
        <?php endwhile; ?>
    </ul>
    <button onclick="showForm()">New Quiz</button>

    <form id="newQuizForm" style="display:none;" action="initializeQuiz.php" method="post">
        <h2>New Quiz</h2>
        <label for="quizName">Quiz Name:</label>
        <input type="text" name="quizName" id="quizName" required>
        <br>
        <input type="submit" value="Submit">
        <button type="button" onclick="hideForm()">Cancel</button>
    </form>
</body>
</html>
