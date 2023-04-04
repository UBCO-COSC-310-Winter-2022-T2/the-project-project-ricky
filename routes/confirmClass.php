<?php
    include 'dbConnection.php';
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $cname = $_POST['cname'];
        $school = $_POST['school'];

        $sql = "INSERT INTO sclass (username, cname, school) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $cname, $school);
        $stmt->execute();

        $stmt->close();
        $conn->close();
    }
?>