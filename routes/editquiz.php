<!DOCTYPE html>
<?php
echo "<body>";
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['qname'])){
    $qname = $_POST['qname'];

    include('dbConnection.php');

    if(isset($_POST['optionA'], $_POST['correctAnswer'])){
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

        $stmt = $conn->prepare('UPDATE question SET content = ?, optionA = ?, optionB = ?, optionC = ?, optionD = ?, answer = ? WHERE qname = ?');
        $stmt->bind_param('ssssssss', $question, $options['A'], $options['B'], $options['C'], $options['D'], $answer, $qname);
    
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
            echo "<form id='newPollForm' action='editquiz.php' method='post' >";
            echo "<fieldset>";
            echo "<input type='hidden' name='qname' value='$qname' >";
            echo "<h2>$qname</h2>";
            echo "<label for='question'>Question:</label>";
            echo "<textarea name='question' id='question' >". $row['content'] ."</textarea>";
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