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
            
            <?php
            include ('functions.php');
                if(isset($_SESSION['username'])){
                    $user = $_SESSION['username'];
                    if(isTeacher($user)){
                        echo "<a href='teacherClasses.php' class='button'>Teacher Portal</a>";
                    }else{
                        echo "<a href='studentportal.php' class='button'>Student Portal</a>";
                    }
                    echo "<a href='logout.php' class='button'>Logout</a>";
                }else{
                    echo "<a href='signup.php' class='button'>Create Account</a>";
                    echo "<a href='select.php' class='button'>Login</a>";
                }
            ?>
        </div>
</header>
