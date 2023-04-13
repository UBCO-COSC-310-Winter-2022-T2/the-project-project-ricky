<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);
        

        switch ($data['command']) {
        case 'startClass':
            $response = [
                'command' => 'startClass',
                'cname' => $data['cname'],
                'school' => $data['school']
            ];
            $this->broadcast(json_encode($response));
            break;
        case 'testMessage':
            $response = [
                'command' => 'testMessage',
                'message' => $data['message']
            ];
            $this->broadcast(json_encode($response));
            break;
        case 'joinClass':
            $response = [
                'command'=>'joinClass',
                'cname' =>$data['cname'],
                'school' => $data['school'],
                'username' =>$data['username']
            ];
            $this->broadcast(json_encode($response));
            break;
        default:
            foreach ($this->clients as $client) {
                if ($from !== $client) {
                    $client->send($msg);
                }
            }
    }
    }
    
    private function broadcast($msg){
        foreach($this->clients as $client){
            $client->send($msg);
        }
    }
}
