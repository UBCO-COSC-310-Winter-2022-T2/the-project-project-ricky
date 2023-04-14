<?php session_start() ?>
<!DOCTYPE html>
<body>
    <div id="studentsList">
        <button id="toggleStudentsButton">List of students</button>

        <table id="studentTable" style="display: none;">
            <tr>
                <th>Student Username</th>
            </tr>
        </table>
    </div>
    <div id='list of quizzes'>
        <table id ='quiz-list'>
            <tr>
                <th>Quiz Name</th>
                <th>Action</th>
            </tr>
            <?php
                include('dbConnection.php');
                
            ?>  

        </table>
        <?php

        ?>
    </div>
</body>

<script>
    const teacherSocket = new WebSocket('ws://localhost:8080');
    
    teacherSocket.addEventListener('message', (event) => {
        console.log('Websocket message:', event.data);

        const data = JSON.parse(event.data);
            const studentTable = document.getElementById('studentTable');
            const newRow = studentTable.insertRow(-1);
            const newCell = newRow.insertCell(0);
            newCell.textContent = data.username;
            
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
</script>
