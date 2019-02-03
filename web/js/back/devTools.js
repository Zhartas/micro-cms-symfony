var flag = true;
$('#devTools button').click(function (e) {
    if(flag) {
        flag = false;
        e.preventDefault();
    }
    $.ajax({
        url: $(this).attr('url'),
        method: 'POST',
        beforeSend: function () {
            activeBeforeNotif();
        },
    }).done(function (res) {
        activeNotif(res);
    });
});