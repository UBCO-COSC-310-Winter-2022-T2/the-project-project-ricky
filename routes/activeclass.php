<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel='stylesheet' href='../css/studentportal.css'>
        <title>Active Teacher Class</title>
    </head>
<body>
    <div id="studentsList">
        <button id="toggleStudentsButton">List of students</button>

        <table id="studentTable" style="display: none;">
            <tr>
                <th>Student Username</th>
            </tr>
        </table>
    </div>
    <br>
    <div id='list of quizzes'>
        <table id ='quiz-list'>
            <tr>
                <th>Quiz Name</th>
                <th>Action</th>
            </tr>
            <?php
                include('dbConnection.php');
                $cname = $_SESSION['active_cname'];
                $school = $_SESSION['active_school'];
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
