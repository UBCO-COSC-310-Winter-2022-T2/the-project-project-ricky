<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/createQuiz.css">

</head>
<header class="header">
    <a href='index.php'><img src="../img/eduPol_logo.PNG" alt="eduPoll Logo"></a>
        <div>
            <a href="signup.php" class="button">Create Account</a>
            <?php
                if(isset($_SESSION['username'])){
                    echo "<a href='logout.php' class='button'>Logout</a>";
                }else{
                    echo "<a href='select.php' class='button'>Login</a>";
                }
            ?>
        </div>
</header>
