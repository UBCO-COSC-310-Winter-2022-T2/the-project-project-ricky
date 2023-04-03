<!DOCTYPE html>
<?php
echo "<body>";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['qname'])){
    $qname = $_POST['qname'];

    include('dbConnection.php');

    if(isset($_POST['optionA'], $_POST['correctAnswer'])){
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

        if(isset($_FILES['image'])){
            $stmt = $conn->prepare('UPDATE question SET content = ?, qImage = ?, optionA = ?, optionB = ?, optionC = ?, optionD = ?, answer = ? WHERE qname = ?');
            $stmt->bind_param('ssssssss', $question, $path, $options['A'], $options['B'], $options['C'], $options['D'], $answer, $qname);
        } else {
            $stmt = $conn->prepare('UPDATE question SET content = ?, optionA = ?, optionB = ?, optionC = ?, optionD = ?, answer = ? WHERE qname = ?');
            $stmt->bind_param('ssssssss', $question, $options['A'], $options['B'], $options['C'], $options['D'], $answer, $qname);
        }

        if ($stmt->execute()){
            echo "Question updated.";
        } else {
            echo "Unable to update question.";
        }
        $stmt->close();

    }

    $stmt = $conn->prepare('SELECT * FROM question WHERE qname = ?');
    $stmt->bind_param('s', $qname);

    if($stmt->execute()){
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()){
            echo "<form id='newPollForm' action='editquiz.php' method='post' enctype='multipart/form-data'>";
            echo "<fieldset>";
            echo "<input type='hidden' name='qname' value='$qname' >";
            echo "<h2>$qname</h2>";
            echo "<label for='question'>Question:</label>";
            echo "<textarea name='question' id='question' >". $row['content'] ."</textarea>";
            echo "<label for='image'>New Image (optional):</label>";
            echo "<input type='file' name='image' id='image' accept='image/*' >";
            echo "<h3>Options:</h3>";
            for ($i = 'A'; $i <= 'D'; $i++){
            echo "<label for='option$i'>Option $i :</label>";
            echo "<input type='text' name='option$i' id='option$i' value=".$row['option' .$i. '']." required><br>";
            }
            echo "<h3>Select Correct Answer:</h3>";
            for ($i = 'A'; $i <= 'D'; $i++){
            echo "<div class='radio-container'>";
            echo "<label for='answer$i'>$i</label>";
            if($row['answer'] == $i){
                echo "<input type='radio' name='correctAnswer' value='$i' id='answer$i' checked='checked' required>"; 
            }else{
            echo "<input type='radio' name='correctAnswer' value='$i' id='answer$i' required>";
            }
            echo "</div>";
            }
            echo "<br>";
            echo "<input type='submit' value='Update'>";
            echo "</fieldset>";
            echo "</form>";
        }
    }
    $stmt->close();


}
echo "</body>";
$conn->close();
?>