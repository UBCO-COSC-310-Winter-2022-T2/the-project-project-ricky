<?php
//this file will insert a new record for a quiz into the database and track the quizname for storing polls of the Quiz
//will be sent to this file form the teachers class page when they click the create quiz button that will ask them to name the quiz
session_start();

$quiz = $_POST['qname'];//get this from form when creat quiz clicked



$_SESSION['qname'] = $quiz;
//store these in session when teacher chooses the class
$class = $_SESSION['cname'];
$school = $_SESSION['school'];

include('dbConnection.php');

$stmt = $conn->prepare("INSERT INTO quiz (qname, cname, school) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $quiz, $class, $school);

if ($stmt->execute()) {
    echo "New poll created successfully";
    header('location: createQuiz.php');
    exit;
} else {
    echo "Error: " . $stmt->error;
}

?>