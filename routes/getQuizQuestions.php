<?php
require_once('dbConnection.php');

$qname = $_POST['qname'];
$query = "SELECT * FROM question WHERE qname = '$qname'";
$result = $conn->query($query);

$questions = [];
$correctAnswers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questions[] = $row;
        $correctAnswers[] = $row['answer'];
    }
}

header('Content-Type: application/json');
echo json_encode(['questions' => $questions, 'correctAnswers' => $correctAnswers]);
?>