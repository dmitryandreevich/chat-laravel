<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 12.05.2018
 * Time: 15:58
 */

namespace App\Socket;


use App\Socket\Base\BaseSocket;
use App\Socket\Base\ChatClient;
use App\Socket\Base\ChatRoom;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\WebSocket\MessageCallableInterface;

class PrivateChat extends BaseSocket
{
    protected $rooms;
    protected $chatClients; // [conn->resourceId] = chatClient object
    public function __construct() {
        $this->clients = new \SplObjectStorage;
        $this->rooms = array();
        $this->chatClients = array();
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $message = json_decode($msg);

        switch ($message->type){
            case 'connect':{
                $value = json_decode(Crypt::decrypt($message->value));

                // получаем объект юзера который отправил запрос и юзера который является собеседником
                $user = User::find($value->userId);
                $companion = User::find($value->companionId);

                $chatClient = new ChatClient($from, $user);
                $room = $this->existRoomForCompanion($user->id);
                // если же нет комнат для него, создаём новую и впускаем его туда
                // а так же говорим, что в комнате ждут ещё юзера с id n
                $this->chatClients[$from->resourceId] = $chatClient;

                if(!$room)
                {
                    $r = new ChatRoom( $chatClient, $companion->id);
                    array_push($this->rooms, $r);
                    echo 'create room';
                }
                else// если пользователь который присоединяется, имеет уже зарезирвированную комнату для него
                {
                    $room->join($chatClient);
                    echo 'join in room';
                }

                break;
            }
        }
        var_dump(json_encode($this->rooms));
    }
    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        $chatClient = $this->chatClients[$conn->resourceId];
        $room = $this->findRoomWithClient($chatClient); // получаем комнату, если он есть там
        if(is_object($room)){
            echo 'exit room';
            $room->exit($chatClient);
            if($room->isEmpty()) {
                unset($this->rooms[array_search($room, $this->rooms)]);
                echo 'room is empty and delete';
            }
        }
        unset($this->chatClients[$conn->resourceId]);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
    /*
     * поиск комнаты с клиентом
     * return object
     * return false если не найден
     * */
    private function findRoomWithClient($client){
        foreach ($this->rooms as $room) {
            $index = array_search($client, $room->getClients());
            if(is_int($index)) return $room;
        }
        return false;
    }
    // есть ли уже зарегистрированная комната для пользователя с id n
    // то вернём её
    private function existRoomForCompanion($id){
        foreach ($this->rooms as $key => $room){
            if($room->isCompanion($id))
                return $room;
        }
        return false;
    }
}