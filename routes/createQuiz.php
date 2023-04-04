<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/createQuiz.css">

    <title>Quiz Creator</title>
    <script>
        function showForm() {
            const form = document.getElementById("newPollForm");
            form.style.display = "block";
        }

        function hideForm() {
            const form = document.getElementById("newPollForm");
            form.style.display = "none";
        }


        function validateForm(event) {
            const question = document.getElementById("question");
            const image = document.getElementById("image");
            
            if (question.value.trim() === "" && !image.files.length) {
                alert("Please enter a question or upload an image, or both.");
                event.preventDefault();
            }
        }
    </script>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<?php include 'headers/header.php'; ?>
<body>
    <h1>Quiz Creator</h1>
    <button onclick="showForm()">Create New Poll</button>

    <form id="newPollForm" class="hidden" action="save_poll.php" method="post" enctype="multipart/form-data" onsubmit="validateForm(event)">
        <h2>New Poll</h2>
        <label for="question">Question:</label>
        <textarea name="question" id="question" rows="4" cols="50" required></textarea>
        
        <h3>Options:</h3>
        <?php for ($i = 'A'; $i <= 'D'; $i++): ?>
            <label for="option<?= $i ?>">Option <?= $i ?>:</label>
            <input type="text" name="option<?= $i ?>" id="option<?= $i ?>" required><br>
        <?php endfor; ?>

        <h3>Select Correct Answer:</h3>
        
        <?php for ($i = 'A'; $i <= 'D'; $i++): ?>
            <div class="radio-container">
            <label for="answer<?= $i ?>"><?= $i ?></label>
            <input type="radio" name="correctAnswer" value="<?= $i ?>" id="answer<?= $i ?>" required>
            </div>
        <?php endfor; ?>
        
        <br>
        <input type="submit" value="Submit">
        <button type="button" onclick="hideForm()">Cancel</button> 

    </form>
</body>
</html>
