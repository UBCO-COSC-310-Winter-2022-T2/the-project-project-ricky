<?php

session_start();

include('dbConnection.php');

$quiz = $_SESSION['qname'];

if(isset($_POST['question'])){
    $question = $_POST['question'];
} else{
    $question = NULL;
}

$options = [];
for ($i = 'A'; $i <= 'D'; $i++) {
    $options[$i] = $_POST["option$i"];
}

$answer = $_POST['correctAnswer'];

$stmt = $conn->prepare("INSERT INTO question (qname, content, optionA, optionB, optionC, optionD, answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $quiz, $question, $options['A'], $options['B'], $options['C'], $options['D'], $answer);

if ($stmt->execute()) {
    echo "New poll created successfully";
    header('location: createQuiz.php');
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
