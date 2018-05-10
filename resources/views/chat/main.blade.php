<?php
/**
 * Created by PhpStorm.
 * User: Dmitry Andreevich
 * Date: 06.04.2018
 * Time: 22:30
 */
?>
@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-8">
        <h3>Общий чат</h3>
        <div class="messages">

        </div>
        <div class="form-group">
            <input type="text" name="" placeholder="Введите сообщение" class="form-control msg-all">
        </div>
        
        
        <button class="btn btn-primary send-all">Отправить</button>
    </div>
    <div class="col-md-4">
        <p class="online">Онлайн: 0</p>
        <ul id="online-users">

        </ul>
    </div>
    <div id="dialog" title="Произошла ошибка!" style="display: none">
        <p>При соединении с сервером произошла ошибка. Попробуйте позже!</p>
    </div>

</div>
<script>
        $('#online-users').menu();

        $(document).ready(function(){

            var socket = new WebSocket("ws://localhost:8080");

            socket.onopen = function(){
                <?php
                     $jsonUser = json_encode(\Illuminate\Support\Facades\Auth::user());
                     $encryptedJsonUser = \Illuminate\Support\Facades\Crypt::encrypt($jsonUser);
                ?>
                var openMessage = {'type':'connect', 'value' : '<?= $encryptedJsonUser ?>'};
                socket.send(JSON.stringify(openMessage));
            };
            socket.onmessage = function(event){
                let message = JSON.parse(event.data);
                receiver( message,
                    () =>{ // if user first connect
                        let users = message.value;
                        console.log(users);
                        users.forEach(function (item, i) {
                            addUser(item);
                        })
                    },
                    () =>{ // if new user join into chat
                        addUser(message.value)
                        appendNewMessage(message.value, true);

                    },
                    () =>{ // if user will disconected
                        console.log(message);
                        deleteUser(message.value);
                    },
                    () =>{ // if need write new message
                        appendNewMessage(message.value);
                    }
                )


            }
            socket.onclose = function(event){
                let message = JSON.parse(event.data);

                console.log(message);
                deleteUser(message.value);
            }
            socket.onerror = function(event){
                $(
                    "#dialog"
                ).dialog();
            }
            $('.send-all').click( () => {
                let msgText = $('.msg-all').val();
                let message = {type: 'message-all', value: msgText};
                socket.send(JSON.stringify(message));

                $('.msg-all').val('');
            });
        });

</script>

@stop
