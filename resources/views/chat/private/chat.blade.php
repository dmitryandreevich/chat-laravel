<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 12.05.2018
 * Time: 15:46
 */
?>
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="private-chat">
                <div class="profile-block">
                    <form action="">
                        <div class="form-group">
                            между ид 1 и ид2
                            <div class="messages"></div>
                            <button class="send-private-message-btn" name="sendPrivateMessage">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){

            var socket = new WebSocket("ws://localhost:8081");

            socket.onopen = function(){
                <?php
                    $userId = $user->id;
                    $companionId = $companion->id;
                    $data = json_encode(['userId' => $userId, 'companionId' => $companionId]);
                    $encryptedData = \Illuminate\Support\Facades\Crypt::encrypt($data);
                ?>
                socket.send(JSON.stringify({type:'connect', value: "{{ $encryptedData }}"}));
            };
            socket.onmessage = function(event){
                let message = JSON.parse(event.data);

            }
            socket.onclose = function(event){
            }
            socket.onerror = function(event){
            }
        });
    </script>
@endsection
