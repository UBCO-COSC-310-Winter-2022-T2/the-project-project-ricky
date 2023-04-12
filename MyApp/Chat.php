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
        // Handle the received message and send it to other clients
        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
        $data=json_encode($msg);
        switch($data->command){
            case 'startClass':
                $response = array(
                    'command' => 'startClass',
                    'cname' => $data->cname,
                    'school' => $data->school
                );
                $this->broadcast(json_encode($response));
                break;
        }
    }
}
