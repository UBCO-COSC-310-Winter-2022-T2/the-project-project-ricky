<?php

session_start();

include('dbConnection.php');

$quiz = $_SESSION['qname'];


if(isset($_POST['image'])){
    $file = pathinfo($_FILES['image']['name'], PATHINFO_BASENAME);
    move_uploaded_file($_FILES['image']['tmp_name'], "../qImages/" . $quiz . $file);
} else{
    $file = NULL;
}
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

$stmt = $conn->prepare("INSERT INTO question (qname, content, qImage, optionA, optionB, optionC, optionD, answer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $quiz, $question, $file, $options['A'], $options['B'], $options['C'], $options['D'], $answer);

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
