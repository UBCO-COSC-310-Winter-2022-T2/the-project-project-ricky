<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/studentportal.css">
    <title><?php if($_SERVER['REQUEST_METHOD']=="GET" and isset($_GET['cname'])){
        echo "cname";
    } ?></title>
</head>
<script>
    const studentSocket = new WebSocket('ws://localhost:8080');
    studentSocket.addEventListener('message', (event) => {
        console.log('WebSocket message received:', event.data); // Add this line for debugging
        const data = JSON.parse(event.data);
        if (data.command == 'startClass' && data.cname == '<?php echo $_GET['cname']; ?>' && data.school == '<?php echo $_GET['school']; ?>') {
            console.log('Displaying the Join Class button'); // Add this line for debugging
            const joinButtonDiv = document.getElementById('joinButton');
            const joinClassButton = document.createElement('button');
            joinClassButton.textContent = 'Join Class';
            joinClassButton.classList.add('joinButton');
            joinClassButton.onclick = function () {
                const joinClassData = {
                    command: 'joinClass',
                    cname: '<?php echo $_GET['cname']; ?>',
                    school: '<?php echo $_GET['school']; ?>',
                    username: '<?php echo $_SESSION['username'];?>'
                }
                studentSocket.send(JSON.stringify(joinClassData));
                window.location.href='activeSclass.php';
            };
            joinButtonDiv.appendChild(joinClassButton);
        }
    });
</script>
<body>
    <div class="main-container">
        <div class="classes-nav">
            <a href=<?php echo $_SERVER['HTTP_REFERER']; ?>><</a>
            <h1><?php if($_SERVER['REQUEST_METHOD']=='GET' and isset($_GET['cname'], $_GET['school'])){echo $_GET['cname'];}?></h1>
        </div>
        <div class="grade">Grade</div>
        <div class="attendance">Attendance</div>
        <div class="text">Wait for your teacher to start the class</div>
        <div id='joinButton'></div>


</body> 