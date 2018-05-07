<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 06.04.2018
 * Time: 22:15
 */

namespace App\Socket;
use App\Socket\Base\BaseSocket;
use App\Socket\Base\ChatClient;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class Chat implements MessageComponentInterface {
    protected $clients;
    protected $authUsers;
    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->authUsers = array();
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        $this->authUsers[$conn->resourceId] = new ChatClient($conn, null);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
//        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
  //          , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
        $message = json_decode($msg);

        switch ($message->type){
            case 'connect':{

                $decryptJsonUser = Crypt::decrypt($message->value);
                $user = json_decode($decryptJsonUser);
                self::getUserByConnId($from->resourceId)->info = $user;

                foreach ($this->clients as $client)
                    $client->send('hello от '.self::getUserByConnId($from->resourceId)->info->name);

                break;
            }
        }
        self::getConnectionByUserId(1);
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        unset($this->authUsers[$conn->resourceId]);

        
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
    private function getConnectionByUserId($id){
        foreach ($this->authUsers as $resourceId  => $authUser) {
            if($authUser->info->id === $id)
                return $authUser->conn;
        }
    }
    private function getUserByConnId($id){
        return $this->authUsers[$id];
    }
}