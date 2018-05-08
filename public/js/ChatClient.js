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
function deleteUser(id) {
    $('#online-users').find('.id'+id).remove();
}
function receiver(message,onConnect,onJoinUser) {
    switch(message.type){
        case 'connect':{
            onConnect();

            break; }
        case 'user-join':{
            onJoinUser(); break;
        }
    }
}