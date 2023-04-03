<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/createQuiz.css">

</head>
<?php session_start(); //since header is included on all pages this the only place i need to start session?> 
<header class="header">
    <img src="../img/eduPol_logo.PNG" alt="eduPoll Logo">
        <div>
            <a href="signup.php" class="button">Create Account</a>
            <a href="select.php" class="button">Login</a>
        </div>
</header>
