function call() {
    var msg = $('#form_search_users').serialize();
    $.ajax({
        type: 'POST',
        url: 'ajax_search_friends.php',
        data: msg,
        success: function (data) {
            $('#results').html(data);
        },
        error: function (xhr, str) {
            alert('Возникла ошибка: ' + xhr.responseCode);
        }
    });

}
