<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/studentportal.css">
        <title>Active Class</title>
        <style>
            #quizContainer {
                text-align: center;
            }

            #quizAnswers {
                list-style-type: none;
                padding: 0;
            }

            #quizAnswers li {
                display: inline-block;
                margin: 0 1em;
            }

            #quizAnswers button {
                background-color: #f8f8f8;
                border: 2px solid #ccc;
                border-radius: 50%;
                color: #333;
                cursor: pointer;
                font-size: 18px;
                padding: 10px 20px;
                width: 80px;
                height: 80px;
                text-align: center;
                transition: background-color 0.3s, border-color 0.3s, color 0.3s;
            }

            #quizAnswers button:hover:not(:disabled) {
                background-color: #e8e8e8;
                border-color: #999;
                color: #333;
            }

            #quizAnswers button:disabled {
                background-color: #73d0b9;
                border-color: #5fb398;
                color: white;
            }

            #correctAnswer {
                font-size: 24px;
                font-weight: bold;
                text-align: center;
                display: none;
            }
        </style>
    </head>
    <body>
        <div class='main-container'>
            <div class="classes-nav">
                <h1>Today's Class</h1>
            </div>
            <div id="quizContainer" style="display: none;">
                <h2 id="quizQuestion"></h2>
                <ul id="quizAnswers">
                    <li><button id="answerA">A</button></li>
                    <li><button id="answerB">B</button></li>
                    <li><button id="answerC">C</button></li>
                    <li><button id="answerD">D</button></li>
                </ul>
            </div>
            <h1 id='correctAnswer'></div>
            <script>
                    activeSocket = new WebSocket('ws://localhost:8080');
                    
                    let currentQuestionIndex = 0;
                    let questions = [];
                    const quizContainer = document.getElementById('quizContainer');
                    const quizQuestion = document.getElementById('quizQuestion');
                    const answerA = document.getElementById('answerA');
                    const answerB = document.getElementById('answerB');
                    const answerC = document.getElementById('answerC');
                    const answerD = document.getElementById('answerD');
                    const answerButtons = [answerA, answerB, answerC, answerD];

                    const correctElement =document.getElementById('correctAnswer');
                    function deselectAll() {
                        answerButtons.forEach(button => {
                            button.disabled = false;
                        });
                    }

                    function sendAnswer(answerIndex) {
                        const answer = String.fromCharCode(65 + answerIndex);
                        activeSocket.send(JSON.stringify({
                            command: 'submitAnswer',
                            answer: answer,
                            questionId: questions[currentQuestionIndex].qid,
                            username: <?php echo json_encode($_SESSION['username']); ?>
                        }));
                    }

                    function showQuestion(question) {
                        deselectAll();
                        quizQuestion.textContent = question.content;
                        answerA.textContent = `A: ${question.optionA}`;
                        answerB.textContent = `B: ${question.optionB}`;
                        answerC.textContent = `C: ${question.optionC}`;
                        answerD.textContent = `D: ${question.optionD}`;
                    }
                    
                    let selectedAnswer = null;
                    activeSocket.addEventListener('message', (event) => {
                        console.log('Websocket message', event.data);
                        const data = JSON.parse(event.data);
                        if (data.command === 'startQuiz') {
                            questions = data.questions;
                            currentQuestionIndex = 0;
                            showQuestion(questions[currentQuestionIndex]);
                            quizContainer.style.display = 'block';
                        } else if (data.command === 'nextQuestion') {
                            currentQuestionIndex++;
                            correctElement.style.display = 'none';
                            if (currentQuestionIndex < questions.length) {
                                showQuestion(questions[currentQuestionIndex]);
                            } else {
                                quizContainer.style.display = 'none';
                                alert('Quiz completed');
                            }
                        }else if (data.command ==='stopQuiz'){
                            if(selectedAnswer!=null){
                                const answer = String.fromCharCode(65 + selectedAnswer);
                                activeSocket.send(JSON.stringify({
                                    command: 'submitAnswer',
                                    answer: answer,
                                    questionId: questions[currentQuestionIndex].qid,
                                    username: <?php echo json_encode($_SESSION['username']); ?>
                                }));
                                selectedAnswer = null;
                            }
                            const correctAnswer = data.correctAnswer;
                            correctElement.style.display = 'block';
                            correctElement.innerHTML =`Correct Answer: ${correctAnswer}`;
                        }
                    });

                    for (const [index, answerButton] of answerButtons.entries()) {
                        answerButton.addEventListener('click', () => {
                            if (selectedAnswer !== null) {
                                answerButtons[selectedAnswer].disabled = false;
                            }
                            selectedAnswer = index;
                            answerButton.disabled = true;
                            sendAnswer(selectedAnswer);
                        });
                    }
                    
                    </script>
                </div>
            </body>
        </html>