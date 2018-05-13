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
                    <div class="form-group">
                        <div class="messages">
                            @foreach($history as $msg)
                                <div class="message">
                                    <div class="sender">
                                        <p class="name">{{ $msg->firstname }}</p>
                                    </div>
                                    <div class="text form-control">{{ $msg->text }}</div>
                                </div>
                            @endforeach
                            <script> resetScrollMessages(); </script>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="message-private form-control" name="msgPrivate" placeholder="Введите сообщение">

                    </div>
                    <button class="send-private-message-btn btn btn-outline-primary w-100" name="sendPrivateMessage">Отправить</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){

            @php
                $userId = $user->id;
                $companionId = $companion->id;
            @endphp
            var socket = new WebSocket("ws://localhost:8081");
            socket.onopen = function(){
                <?php
                    $data = json_encode(['userId' => $userId, 'companionId' => $companionId]);
                    $encryptedData = \Illuminate\Support\Facades\Crypt::encrypt($data);
                ?>
                socket.send(JSON.stringify({type:'connect', value: "{{ $encryptedData }}"}));
            };
            socket.onmessage = function(event){
                let message = JSON.parse(event.data);
                if(message.type == 'message'){
                    console.log(message);
                    appendNewMessage(message.value);
                }

            }
            socket.onclose = function(event){
            }
            socket.onerror = function(event){
            }
            function sendMessage() {
                let text = $('.message-private').val();
                if(text != ""){
                    let request = {type: 'message', value:{'senderId': "{{ \Illuminate\Support\Facades\Crypt::encrypt($userId) }}",
                            'companionId': "{{ \Illuminate\Support\Facades\Crypt::encrypt($companionId) }}",
                            text: text}};
                    socket.send(JSON.stringify(request));
                    $('.message-private').val("");
                }
            }
            $(document).keyup(function (e) {
                if(e.which == 13)
                    sendMessage();
            });
            $('.send-private-message-btn').click(() => sendMessage());
        });
    </script>
@endsection
