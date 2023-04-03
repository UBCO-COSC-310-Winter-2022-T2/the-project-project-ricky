<?php

session_start();

include('dbConnection.php');

$quiz = $_SESSION['qname'];

if(isset($_FILES['image'])){
    $target_dir = "../qImages/";
    $file = $target_dir . $quiz . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 100000) { 
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if (file_exists($file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
      }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $file)) {
            echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    unset($_FILES['image']);
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
$stmt->bind_param("ssssssss", $quiz, $question, $file, $options['A'], $options['B'], $options['C'], $options['D'], $answer);

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
