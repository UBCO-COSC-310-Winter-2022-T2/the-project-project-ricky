<?php
session_start();
if (isset($_POST['cname']) && isset($_POST['school'])) {
    $_SESSION['active_cname'] = $_POST['cname'];
    $_SESSION['active_school'] = $_POST['school'];
   //  header('Location: activeclass.php');
} else {
    die("Invalid class information");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Active Class</title>
	<style>
		.main-container {
		    width: 80%;
		    margin: 0 auto;
		}

		.classes-nav {
		    background-color: #73d0b9;
		    display: flex;
		    color: black;
		    align-items: center;
		    justify-content: center;
		    height: 3em;
		    display: flex;
		    justify-content: space-between;
		    align-items: center;
		    padding: 1em;
		    position: relative;
		}

		.classes-nav h1 {
		    margin: 0;
		    position: absolute;
		    left: 50%;
		    transform: translateX(-50%);
		}

		.course-card {
		    background-color: #f8f8f8;
		    padding: 1em;
		    margin: 1em 0;
		    border-radius: 4px;
		    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
		}

		.course-card h2 {
		    margin: 0 0 0.5em;
		    font-size: 24px;
		}

		.course-card p {
		    margin: 0;
		    font-size: 18px;
		}
		.add-class-btn {
		    font-size: 48px;
		    text-decoration: none;
		    /* background-color: #99ddcc; */
		    font-weight: bold;
		    /* border: 1px solid #ccc; */
		    /* border-radius: 4px; */
		    padding: 5px 10px;
		    color: white;
		    position: absolute;
		    top: 50%;
		    right: 1em;
		    transform: translateY(-50%);
		}
		.add-class-btn:hover {
		    background-color: #bfeadf;
		    color: black;
		}
		.class-card-link{
		    display:block;
		    text-decoration: none;
		    color: inherit;
		}
		.class-card {
		    background-color: #f8f8f8;
		    border: 1px solid #ccc;
		    border-radius: 4px;
		    padding: 1em;
		    margin-bottom: 1em;
		    cursor: pointer;
		}
		.class-card:hover{
		    background-color: #e8e8e8;
		    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
		}
		.class-list {
		    margin-top: 1em;
		}
		#testButton {
			background-color: #73d0b9;
			color: white;
			padding: 1em 2em;
			font-size: 18px;
			border-radius: 4px;
			cursor: pointer;
			transition: all 0.3s ease;
         display: block;
         margin: 0 auto;
		}
      #testButton:hover {
			background-color: #63b0a9;
		}
	</style>
</head>
<body>
	<div class="main-container">
		<div class="classes-nav">
			<h1>Active Class</h1>
			<a href="addclass.html" class="add-class-btn">+</a>
		</div>
		<br>
      <h1>Class start successful!</h1>
		<button id="testButton">Go to active class</button>
	</div>
	<script>
	   const socket= new WebSocket('ws://localhost:8080');
	   socket.addEventListener('message', (event)=>{
	      console.log('Websocket message:', event.data);
	   });
	   
	   socket.addEventListener('open', (event) => {
	      console.log(('Websocket connected: ', event));
	   });

	   testButton = document.getElementById('testButton');
	   testButton.addEventListener('click', ()=>{
	      const msg = {
	         command: 'startClass',
	         cname: '<?php echo $_SESSION['active_cname']; ?>',
	         school: '<?php echo $_SESSION['active_school']; ?>'
	      };
	      socket.send(JSON.stringify(msg));
	      window.location.href='activeclass.php';
	   });
	</script>
</body>
</html>