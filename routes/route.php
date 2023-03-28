<?php 
if (isset($_POST['student'])) {
header("Location: loginS.php");
}
elseif(isset($_POST['teacher'])){
    header("Location: loginT.php");
}
?>