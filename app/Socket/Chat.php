<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 06.04.2018
 * Time: 22:15
 */

namespace App\Socket;
use App\Socket\Base\BaseSocket;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Ratchet\ConnectionInterface;

class Chat extends BaseSocket
{
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        // Create a new session handler for this client
        $session = (new SessionManager(App::getInstance()))->driver();
        // Get the cookies
        $cookies = $conn->httpRequest->getHeader('Cookie');
        // Get the laravel's one
        $laravelCookie = urldecode($cookies[Config::get('session.cookie')]);
        // get the user session id from it
        $idSession = Crypt::decrypt($laravelCookie);
        // Set the session id to the session handler
        $session->setId($idSession);
        // Bind the session handler to the client connection
        $conn->session = $session;

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // start the session when the user send a message
        // (refreshing it to be sure that we have access to the current state of the session)
        $from->session->start();
        // do what you wants with the session
        // for example you can test if the user is auth and get his id back like this:
        $idUser = $from->session->get(Auth::getName());
        if (!isset($idUser)) {
            echo "the user is not logged via an http session";
        } else {
            $currentUser = User::find($idUser);
        }
        // or you can save data to the session
        $from->session->put('foo', 'bar');
        // ...
        // and at the end. save the session state to the store
        $from->session->save();
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}