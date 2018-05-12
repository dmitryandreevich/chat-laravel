function setOnline(count) {
    $('.online').text(count);
}
function addUser(data) {
    let usersMenu = $('#online-users');
    let block = `
        <li class="user-online ui-menu-item id-${data.id}">
                <div class="user-name">${data.firstname + ' ' + data.secondname}</div>
                <ul class="user-options">
                    <li class=""><div class="ui-state-disabled">Меню</div></li>
                    <li><div><a href="/profile/id${data.id}"><span class="ui-icon ui-icon-mail-closed"></span>Профиль</a></div></li>
                    <li><div><a href="/chat/private/id${data.id}">Личное сообщение</a></div></li>
                </ul>
            </li>
    `;
    usersMenu.append(block);
    usersMenu.menu('refresh');
}
function appendNewMessage(data, isJoin = false) {
    let messages = $('.messages');
    let block = `
        <div class="message">
            <div class="sender">
                <p class="name">${data.firstname}</p>
            </div>
            <div class="text">${ isJoin ? 'Вошёл в чат.' : data.message }</div>
        </div>
    `;
    messages.append(block);
    messages.stop().animate({
        scrollTop: messages[0].scrollHeight
    },500);

    ion.sound.play('message');
}
function sendMessageAll(ws) {
    let msgText = $('.msg-all').val();
    let message = {type: 'message-all', value: msgText};
    if(msgText != ""){
        ws.send(JSON.stringify(message));
        $('.msg-all').val('');
    }
}
function deleteUser(id) {
    $('#online-users').find('.id-'+id).remove();
}
function receiver(message,onConnect,onJoinUser, onUserClose, onMessageAll) {
    switch(message.type){
        case 'connect':{
            onConnect();

            break; }
        case 'user-join': {
            onJoinUser();
            break;
        }
        case 'user-close':{
            onUserClose();
            break;
        }
        case 'message-all':{
            onMessageAll();
            break;
        }
    }
}
