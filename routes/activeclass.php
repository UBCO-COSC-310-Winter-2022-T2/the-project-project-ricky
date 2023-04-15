<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel='stylesheet' href='../css/studentportal.css'>
        <title>Active Teacher Class</title>
        <script src='https://cdn.jsdelivr.net/npm/chart.js'></script>
        <link rel='stylesheet' href='../css/studentportal.css'>
        <style>
        body {
                font-family: Arial, sans-serif;
            }

            #studentsList,
            #quizzes {
                display: inline-block;
                vertical-align: top;
                margin: 1em;
            }

            #toggleStudentsButton,
            .start-quiz-button,
            #stopQuizButton,
            #nextQuestionButton {
                background-color: #f8f8f8;
                border: 2px solid #ccc;
                border-radius: 5px;
                color: #333;
                cursor: pointer;
                font-size: 18px;
                padding: 10px;
                transition: background-color 0.3s, border-color 0.3s, color 0.3s;
                margin: 0 1em 1em 0;
            }

            #toggleStudentsButton:hover,
            .start-quiz-button:hover,
            #stopQuizButton:hover,
            #nextQuestionButton:hover {
                background-color: #e8e8e8;
                border-color: #999;
                color: #333;
            }

            #studentTable {
                border-collapse: collapse;
                width: 100%;
            }

            #studentTable th,
            #studentTable td {
                border: 1px solid #ccc;
                padding: 10px;
                text-align: left;
            }

            #studentTable th {
                background-color: #f2f2f2;
                font-weight: bold;
            }

            #answerChart {
                width: 100%;
                height: 300px;
            }

            #quizList {
                list-style-type: none;
                padding: 0;
            }

            #quizList li {
                margin-bottom: 1em;
            }
        </style>
    </head>
<body>
    <div class='classes-nav'>
            <a href='teacherClasses.php'>End class</a>
            <h1>Today's class</h1>
    </div>
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
            <button id='stopQuizButton'>Stop Question</button>
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

        if (data.command === 'studentJoin') {
        const studentTable = document.getElementById('studentTable');
        const newRow = studentTable.insertRow(-1);
        const newCell = newRow.insertCell(0);
        newCell.textContent = data.username;
        } else if (data.command === 'studentAnswer') {
            // const studentAnswers = document.getElementById('studentAnswers');
            // const newRow = studentAnswers.insertRow(-1);
            // const usernameCell = newRow.insertCell(0);
            // const answerCell = newRow.insertCell(1);
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

    const startQuizButtons = document.getElementsByClassName('start-quiz-button');
    let correctAnswers = [];
    let currentQuestionIndex=0;

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
            const data = await response.json();
            const questions = data.questions;
            correctAnswers = data.correctAnswers;
            teacherSocket.send(JSON.stringify({command: 'startQuiz',quizName, questions}));
        });
    }
    const stopQuestion = document.getElementById('stopQuizButton');
    stopQuestion.addEventListener('click', ()=>{
        const currentCorrectAnswer =correctAnswers[currentQuestionIndex];
        teacherSocket.send(JSON.stringify({
            command: 'stopQuiz',
            correctAnswer: currentCorrectAnswer
        }));
        stopQuestion.style.display='none';

    })




    const nextQuestionButton = document.getElementById('nextQuestionButton');

    nextQuestionButton.addEventListener('click', () => {
        teacherSocket.send(JSON.stringify({
            command: 'nextQuestion'
        }));
        currentQuestionIndex++;
        stopQuestion.style.display='block';
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
