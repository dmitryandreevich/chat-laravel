<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 07.05.2018
 * Time: 19:20
 */

namespace App\Socket\Base;

use Ratchet\ConnectionInterface;
class ChatClient
{
    public $conn;
    public $info;

    public function __construct(ConnectionInterface $conn, $info)
    {
        $this->conn = $conn;
        $this->info = $info;
    }
}