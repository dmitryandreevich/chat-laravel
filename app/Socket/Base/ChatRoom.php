<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 12.05.2018
 * Time: 16:09
 */

namespace App\Socket\Base;


class ChatRoom
{
    protected $clients;
    protected $companionId;
    public function __construct(ChatClient $client, $companionId)
    {
        $this->clients = [$client];
        $this->companionId = $companionId;
    }

    public function join(ChatClient $client){
        return array_push($this->clients, $client);
    }
    public function exit(ChatClient $client){
        $id = array_search($client, $this->clients);
        unset($this->clients[$id]);
    }

    public function isCompanion($companionId)
    {
        return $this->companionId === $companionId;
    }
    public function isEmpty(){
        return count($this->clients) == 0;
    }
    public function getClients(){
        return $this->clients;
    }
    public function destroy(){
        echo 'Room destroy';
        unset($this);
    }

}