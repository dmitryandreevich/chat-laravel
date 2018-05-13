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

class Chat extends BaseSocket{
    protected $authUsers;
    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->authUsers = array();
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        $this->authUsers[$conn->resourceId] = new ChatClient($conn, null);

        $this->sendAllUsers($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1; // count current users online


        $message = json_decode($msg);

        switch ($message->type){
            case 'connect':{

                $decryptJsonUser = Crypt::decrypt($message->value);
                $user = json_decode($decryptJsonUser);
                self::getUserByConnId($from->resourceId)->info = $user;
                $message = json_encode($this->createMessageTemplate('user-join',[
                    'firstname' => $user->name, 'secondname' => $user->secondName, 'id' => $user->id
                ]));
                // формируем сообщение всем клиентам при подключении нового клиента

                $this->sendMessageAll($message);

                break;
            }
            // если пришёл запрос на отправку сообщения всем пользователям
            // формируем ответ, содержащий информацию о получателе и само сообщение
            case 'message-all':{
                $sender = $this->getUserByConnId($from->resourceId);
                $response = $this->createMessageTemplate('message-all',
                    ['id' => $sender->info->id, 'firstname' => $sender->info->name,
                        'secondname' => $sender->info->secondName, 'text' => $message->value]);
                $this->sendMessageAll(json_encode($response)); // отправляем всем пользователям сформированный ответ
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        // Когда пользователь закрывает соединение с WS, отправляем всем клиентам эту информацию
        // Чтобы клиентская часть смогла обработать это событие у всех
        $closedUserId = $this->authUsers[$conn->resourceId]->info->id;
        $message = json_encode($this->createMessageTemplate('user-close', $closedUserId));
        foreach ($this->clients as $client)
            $client->send($message);


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
    // необходим для отправки всех пользователей определенному соединению
    private function sendAllUsers(ConnectionInterface $conn){
        $message = $this->createMessageTemplate('connect', []);
        $jsonMessage = null;
        foreach ($this->authUsers as $user) {
            if($user->info !== null) {
                var_dump($user->info);
                array_push($message['value'],
                    ['id' => $user->info->id, 'firstname' => $user->info->name, 'secondname' => $user->info->secondName]);
            }
            $jsonMessage = json_encode($message);
        }
        $conn->send($jsonMessage);

        return false;
    }

}