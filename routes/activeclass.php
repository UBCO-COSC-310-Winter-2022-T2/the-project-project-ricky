<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel='stylesheet' href='../css/studentportal.css'>
        <title>Active Teacher Class</title>
        <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
    </head>
<body>
    <div id="studentsList">
        <button id="toggleStudentsButton">List of students</button>

        <table id="studentTable" style="display: none;">
            <tr>
                <th>Student Username</th>
            </tr>
        </table>
        <!-- <table id="studentAnswers">
            <tr>
                <th>Student Username</th>
                <th>Answer</th>
            </tr>
        </table> -->
        <canvas id='answerChart'></canvas>
    </div>
    <br>
    <div id='quizzes'>
        <h3>Quizzes</h3>
        <ul id='quizList'>
            <?php
                include('dbConnection.php');
                $cname = $_SESSION['active_cname'];
                $school = $_SESSION['active_school'];
                $query = "SELECT qname FROM quiz WHERE cname = '$cname' AND school = '$school'";
                $result = $conn->query($query);
                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                        echo "<li><button class='start-quiz-button' data-quiz-name='{$row['qname']}'>{$row['qname']}</button></li>";
                    }
                }else{
                    echo"<li>No quizzes available for this class</li>";
                }
            ?>
            <button id="nextQuestionButton">Next Question</button>
        </ul>        
    </div>
</body>

<script>
    const teacherSocket = new WebSocket('ws://localhost:8080');
    const studentAnswers = document.getElementById('studentAnswers');
    teacherSocket.addEventListener('message', (event) => {
        console.log('Websocket message:', event.data);

        const data = JSON.parse(event.data);

        const studentTable = document.getElementById('studentTable');
        const newRow = studentTable.insertRow(-1);
        const newCell = newRow.insertCell(0);
        newCell.textContent = data.username;

        if (data.command === 'studentAnswer') {
            const newRow = studentAnswers.insertRow(-1);
            const usernameCell = newRow.insertCell(0);
            const answerCell = newRow.insertCell(1);
            answerCounts[data.answer]++;
            chartData.datasets[0].data = Object.values(answerCounts);
            answerChart.update();
            usernameCell.textContent = data.username;
            answerCell.textContent = data.answer;
        }
            
    });

    const toggleStudentsButton = document.getElementById('toggleStudentsButton');
    toggleStudentsButton.addEventListener('click', () => {
        const studentTable = document.getElementById('studentTable');
        if (studentTable.style.display === 'none') {
            studentTable.style.display = 'table';
        } else {
            studentTable.style.display = 'none';
        }
    });

    const startQuizButtons = document.getElementByClassName('start-quiz-button');
    for(const startQuizButton of startQuizButtons){
        startQuizButton.addEventListener('click', async () =>{
            const quizName = startQuizButton.getAttribute('data-quiz-name');
            const response = await fetch('getQuizQuestions.php', {
                method: 'POST',
                headers:{
                    'Content-type': 'application/x-www-form-urlencoded'
                },
                body: `qname=${encodeURIComponent(quizName)}`
            });
            const questions = await response.json();
            teacherSocket.send(JSON.stringify({command: 'startQuiz',quizName, questions}));
        });
    }
    const nextQuestionButton = document.getElementById('nextQuestionButton');

    nextQuestionButton.addEventListener('click', () => {
        teacherSocket.send(JSON.stringify({
            command: 'nextQuestion'
        }));
    });
    const answerChartCanvas = document.getElementById('answerChart').getContext('2d');
    const answerCounts = { A: 0, B: 0, C: 0, D: 0};
    const chartData = {
        labels: ['A', 'B', 'C', 'D'],
        datasets: [
            {
                label: 'Student Answers',
                data: [0, 0, 0, 0],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }
        ]
    };

    const answerChart = new Chart(answerChartCanvas, {
        type: 'bar',
        data: chartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
