<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/studentportal.css">
        <title>Active Class</title>
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
                    function showQuestion(question) {
                        quizQuestion.textContent = question.content;
                        answerA.textContent = `A: ${question.optionA}`;
                        answerB.textContent = `B: ${question.optionB}`;
                        answerC.textContent = `C: ${question.optionC}`;
                        answerD.textContent = `D: ${question.optionD}`;
                    }
                    activeSocket.addEventListener('message',(event)=>{
                        console.log('Websocket message', event.data);
                        const data = JSON.parse(event.data);
                        if(data.command==='startQuiz'){
                            questions = data.questions;
                            currentQuestionIndex = 0;
                            showQuestion(questions[curretnQuestionIndex]);
                            quizContainer.style.display = 'block';
                        }
                    });
                    for (const [index, answerButton] of answerButtons.entries()) {
                        answerButton.addEventListener('click', () => {
                            const answer = String.fromCharCode(65 + index); // Converts 0 to 'A', 1 to 'B', etc.
                            activeSocket.send(JSON.stringify({
                                command: 'submitAnswer',
                                answer: answer,
                                questionId: questions[currentQuestionIndex].qid
                            }));
                            // currentQuestionIndex++;
                            // if (currentQuestionIndex < questions.length) {
                            //     showQuestion(questions[currentQuestionIndex]);
                            // } else {
                            //     quizContainer.style.display = 'none';
                            //     alert('Quiz completed');
                            // }
                        });
                    }
                    
            </script>
        </div>
    </body>
</html>