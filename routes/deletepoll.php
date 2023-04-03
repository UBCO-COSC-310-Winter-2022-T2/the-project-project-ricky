<?php
session_start();
include('dbConnection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['qid'])) {
    $qid = $_POST['qid'];

    $stmt = $conn->prepare("DELETE FROM question WHERE qid = ?");
    $stmt->bind_param("s", $qid);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

header("Location: editquiz.php");
exit;
?>