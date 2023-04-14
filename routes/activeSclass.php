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
            <div class='class-content'>
                <script>
                    activeSocket = new WebSocket('ws://localhost:8080');
                    activeSocket.addEventListener('message', (event)=>{
                        console.log('Websocket message: 'event.data);
                        const data = JSON.parse(event.data);
                        
                    }
                        
                    )
                </script>
            </div>  
        </div>
    </body>
</html>