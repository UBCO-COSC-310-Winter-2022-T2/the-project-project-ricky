<?php
$servername = "db";
$username_db = "cosc310user";
$password_db = "1234";
$dbname = "edupol";
$conn = new mysqli($servername, $username_db, $password_db, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>