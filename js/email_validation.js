$(document).ready(function () {
    "use strict";
    //================ Проверка email ==================
    var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;    //регулярное выражение для проверки email
    var mail = $('input[name=email]');
    mail.blur(function () {
        if (mail.val() != '') { // если email не пустой
            if (mail.val().search(pattern) == 0) { // Проверяем, если введенный email соответствует регулярному выражению
                $('#valid_email_message').text(''); // Убираем сообщение об ошибке
                $('input[type=submit]').attr('disabled', false); //Активируем кнопку отправки
            } else { // если введенный email не соответсвует регулярке
                $('#valid_email_message').text('Не правильный Email'); //Выводим сообщение об ошибке
                $('input[type=submit]').attr('disabled', true); // Дезактивируем кнопку отправки
            }
        } else { // если email пустой
            $('#valid_email_message').text('Введите Ваш email');
        }
    });

});
