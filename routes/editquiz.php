<!DOCTYPE html>
<?php
include('headers/header.php');
echo "<body>";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['qname'])){
    $qname = $_POST['qname'];

    include('dbConnection.php');

    if(isset($_POST['optionA'], $_POST['correctAnswer'])){
        if (isset($_POST['image'])) {
            $file = $qname . pathinfo($_FILES['image']['name'], PATHINFO_BASENAME);
            $path = "../qImages/" . $file;
            if (file_exists($path)) {
                unlink($path);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], $path);
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

        $stmt = $conn->prepare('UPDATE questiions SET content = ?, qImage = ?, optionA = ?, optionB = ?, optionC = ?, optionD = ?, answer = ? WHERE qname = ?');
        $stmt->bind_param('ssssssss', $question, $file, $options['A'], $options['B'], $options['C'], $options['D'], $correctAnswer, $qname);

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
            echo "<h2>". $qname . "</h2>";
            echo "<label for='question'>Question:</label>";
            echo "<textarea name='question' id='question' value='$qname'></textarea>";
            echo "<label for='image'>Image (optional):</label>";
            echo "<input type='file' name='image' id='image' accept='image/*' value=" .$row['qImage']. ">";
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