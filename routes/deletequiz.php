<?php
session_start();

include('dbConnection.php');

$cname = $_SESSION['cname'];
$school = $_SESSION['school'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['qname'])) {
    $qname = $_POST['qname'];

    $stmt = $conn->prepare("DELETE FROM quiz WHERE qname = ? AND cname = ? AND school = ?");
    $stmt->bind_param("sss", $qname, $cname, $school);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
