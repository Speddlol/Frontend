<?php
// app/WebSocketServer.php

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketServer implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Add the new connection to the clients list
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // Do nothing for incoming messages
    }

    public function onClose(ConnectionInterface $conn) {
        // Remove the connection from the clients list
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        // Log any errors
        echo "Error: " . $e->getMessage();
    }

    public function sendPlayers(array $players) {
        $data = [
            'type' => 'players',
            'data' => $players,
        ];

        $message = json_encode($data);

        // Send the message to all connected clients
        foreach ($this->clients as $client) {
            $client->send($message);
        }
    }
}

