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

    public function __construct(ChatClient $client)
    {
        $this->clients = array();
    }
    public function joinToRoom(ChatClient $client){
        return array_push($this->clients, $client);
    }
    public function exitOfRoom(ChatClient $client){
        $id = array_search($client, $this->clients);
        unset($this->clients[$id]);
    }
    public function inRoom(ChatClient $occupant){
        return in_array($occupant, $this->occupants);
    }

}