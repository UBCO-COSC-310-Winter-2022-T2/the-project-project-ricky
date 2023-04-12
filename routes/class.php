<?php

session_start();
include('dbConnection.php');

if(isset($_SESSION['cname'])){
    $cname = $_SESSION['cname'];
}
if(isset($_SESSION['school'])){
    $school = $_SESSION['school'];
}  
//check of quiz exists
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $quiz = $_POST['qname'];//get this from form when creat quiz clicked

    $_SESSION['qname'] = $quiz;
   
    $stmt = $conn->prepare("SELECT * FROM quiz WHERE qname = ? AND cname = ? AND school = ?");
    $stmt->bind_param("sss", $quiz, $cname, $school);

    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->fetch_assoc()) {
            $errorMessage = "Quiz already exists, Choose a different name";
        }else{		

            $stmt = $conn->prepare("INSERT INTO quiz (qname, cname, school) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $quiz, $cname, $school);

            if ($stmt->execute()) {
                // echo "New Quiz created successfully";
                $_SESSION['message']= "New quiz ".$quiz." created succesfully";
                header('location: createQuiz.php');
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $conn->close();
}
if(!isset($_GET['cname'], $_GET['school'])){
    die("null class");
} 
$cname = $_GET['cname'];
$school = $_GET['school'];

//for testing
// $cname = "Test Class";
// $school = "UBC";
$_SESSION['cname'] = $cname;
$_SESSION['school'] = $school;

$errorMessage = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $school. ": " .$cname; ?></title>
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
<?php include('headers/header.php'); ?>
<body>
    <h1><?php echo $school. ": " .$cname; ?></h1>
    <h2>Students</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Grade</th>
        </tr>
        <?php 
        $stustmt = $conn->prepare("SELECT firstName, lastName, grade FROM student NATURAL JOIN sclass WHERE cname = ? and school = ?");
        $stustmt->bind_param("ss", $cname, $school); 
        if($stustmt->execute()):
            $result = $stustmt->get_result();
            while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['firstName'] . " " . $row['lastName']?></td>
            <td><?= $row['grade'] ?></td>
        </tr>
        <?php endwhile; 
            endif;
        ?>
        <tr>
            <td colspan="3">
                <form action='startclass.php' method='post'>
                    <input type='hidden' name='cname' value='<?=$cname?>'>
                    <input type='hidden' name='school' value='<?=$school?>'>
                    <input type='submit' value='Start Class'>
                </form>    
            </td>   
        </tr>
    </table>

    <h2>Quizzes</h2>
    <table>
        <tr>
            <th>Quiz Name</th>
            <th></th>
        </tr>
        <?php 
        $quizstmt = $conn->prepare("SELECT * FROM quiz WHERE cname = ? and school = ?"); 
        $quizstmt->bind_param("ss", $cname, $school); 
        if($quizstmt->execute()):
            $result = $quizstmt->get_result();
            while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['qname'] ?></td>
            <td>
                <form action="editquiz.php" method="post">
                <input type="hidden" name="qname" value="<?=$row['qname']?>">
                <input type="submit" value="Edit Quiz">
                </form>
            </td>    
            <td>
                <form action="deletequiz.php" method="post">
                <input type="hidden" name="qname" value="<?=$row['qname']?>">
                <input type="submit" value="Delete Quiz">
                </form>
            </td>    
        </tr>
        <?php endwhile; 
            endif;
    
        ?>
    </table>
    <button onclick="showForm()">New Quiz</button>
    <?php echo "<p style='color: red;'>$errorMessage</p>"; ?>

    <form id="newQuizForm" style="display:none;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>New Quiz</h2>
        <label for="quizName">Quiz Name:</label>
        <input type="text" name="qname" id="quizName" required>
        <br>
        <input type="submit" value="Submit">
        <button type="button" onclick="hideForm()">Cancel</button>
    </form>
</body>
</html>
