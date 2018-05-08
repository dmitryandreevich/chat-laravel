function setOnline(count) {
    $('.online').text(count);
}
function addUser(data) {
    let usersMenu = $('#online-users');
    let block = `
        <li class="user-online ui-menu-item id-${data.id}">
                <div class="user-name">${data.firstname + ' ' + data.secondname}</div>
                <ul class="user-options">
                    <li class="ui-state-disabled">Меню</li>
                    <li><a href="/profile/id${data}">Профиль</a></li>
                    <li><a href="">Отправить сообщение</a></li>
                </ul>
            </li>
    `;
    usersMenu.append(block);
    usersMenu.menu('refresh');
}
function appendNewMessage(data) {
    let messages = $('.messages');
    let block = `
        <div class="message">
            <div class="sender">
                <p class="name">${data.sendername}</p>
            </div>
            <div class="text">${data.message}</div>
        </div>
    `;
    messages.append(block);
    messages.stop().animate({
        scrollTop: messages[0].scrollHeight
    },500);

    ion.sound.play('message');
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