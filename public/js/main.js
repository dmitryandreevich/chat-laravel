function giveLike(button) {
    let publicationId = $(button).attr('id');
    $.ajax({
        url: 'publications/givelike',
        method: 'post',
        data : {pId: publicationId},
        dataType: 'html',
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            console.log('test ' + publicationId);
            $(`.btn-like[id=${publicationId}]>i`).text(response);

        },
        error: function(msg){
            console.log(msg);
        }
    });
}