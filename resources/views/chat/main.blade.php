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
        <div class="col-md-12">
            <h1>Общий чат</h1>
            <div class="messages"></div>
            <div class="form-group">
                <input type="text" name="" placeholder="Введите сообщение" class="form-control msg-all">
            </div>
            <button class="btn btn-primary send-all">Отправить</button>
        </div>

</div>
<div class="row">

    <div class="col-md-12">
        <h4 class="status">status</h4>
    </div>
</div>
<script>
            $(document).ready(function(){
                var socket = new WebSocket("ws://localhost:8080");

                socket.onopen = function(){

                };
                socket.onmessage = function(event){

                }
                socket.onclose = function(event){

                }
                socket.onerror = function(event){

                }
            });
</script>

@stop
