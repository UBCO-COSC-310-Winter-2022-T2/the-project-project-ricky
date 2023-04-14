<?php
session_start();
if (isset($_POST['cname']) && isset($_POST['school'])) {
    $_SESSION['active_cname'] = $_POST['cname'];
    $_SESSION['active_school'] = $_POST['school'];
   //  header('Location: activeclass.php');
   echo 'class start successful';
} else {
    die("Invalid class information");
}
?>
<button id = 'testButton'>Go to active class</button>
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
         cname: '<?php echo $_POST['cname']; ?>',
         school: '<?php echo $_POST['school']; ?>'
      };
      socket.send(JSON.stringify(msg));
      window.location.href='activeclass.php';
   });
</script>