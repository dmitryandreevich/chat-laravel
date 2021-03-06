<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 12.05.2018
 * Time: 15:58
 */

namespace App\Socket;


use App\MessageHistory;
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
                $value = json_decode( Crypt::decrypt($message->value) );

                // получаем объект юзера который отправил запрос и юзера который является собеседником
                $user = User::find($value->userId);
                $companion = User::find($value->companionId);

                $chatClient = new ChatClient($from, $user);
                $room = $this->findRoomForCompanion($user->id);
                // если же нет комнат для него, создаём новую и впускаем его туда
                // а так же говорим, что в комнате ждут ещё юзера с id n
                $this->chatClients[$from->resourceId] = $chatClient;

                if(!$room) {
                    $r = new ChatRoom($chatClient, $companion->id);
                    array_push($this->rooms, $r);
                    echo "Server was create new room!\n";
                } else {// если пользователь который присоединяется, имеет уже зарезирвированную комнату для него
                    $room->join($chatClient);
                    echo "Client was join in room\n";
                }
                break;
            }
            case 'message':{
                $value = $message->value;
                $senderId = Crypt::decrypt($value->senderId);
                $companionId = Crypt::decrypt($value->companionId);

                $text = $value->text;
                $room = $this->findRoomWithClient($this->chatClients[$from->resourceId]);

                if($room !== false) {
                    $sender = $this->chatClients[$from->resourceId];
                    $response = $this->createMessageTemplate('message',['id' => $sender->info->id, 'firstname' => $sender->info->name,
                        'secondname' => $sender->info->secondName, 'text' => $text,'avatar' => $sender->info->avatar]);

                    foreach ($room->getClients() as $client) {
                        $client->conn->send( json_encode($response) );
                    }
                }

                MessageHistory::create( ['sender' => $senderId, 'receiver' => $companionId, 'text' => $text] );
                break;
            }
        }
    }
    public function onClose(ConnectionInterface $conn) {

        $this->clients->detach($conn);
        $chatClient = $this->chatClients[$conn->resourceId];
        $room = $this->findRoomWithClient($chatClient); // получаем комнату, если он есть там

        if( is_object($room) ){
            echo "Client exited of room\n";
            $room->exit($chatClient);
            if( $room->isEmpty() ) {
                unset($this->rooms[array_search($room, $this->rooms)]);
                echo "Room is empty and was deleted\n";
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
            if( is_int($index) ) return $room;
        }
        return false;
    }
    // есть ли уже зарегистрированная комната для пользователя с id n
    // то вернём её
    private function findRoomForCompanion($id){
        foreach ($this->rooms as $key => $room){
            if($room->isCompanion($id))
                return $room;
        }
        return false;
    }
}