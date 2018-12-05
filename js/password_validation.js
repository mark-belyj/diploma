$(document).ready(function () {
    "use strict";
//================ Проверка длины пароля ==================
    var password = $('input[name=password]');
    password.blur(function () {
        if (password.val() == '') { // ЕСЛИ пароль пустой
            $('input[type=submit]').attr('disabled', true); // Дезактивируем кнопку отправки
            $('#valid_password_message').text('Введите пароль'); //Выводим сообщение об ошибке
        } else { // если пароль не пустой
            if (password.val().length < 6) {
                $('input[type=submit]').attr('disabled', true);// Дезактивируем кнопку отправки
                $('#valid_password_message').text('Минимальная длина пароля 6 символов');//Выводим сообщение об ошибке
            } else {
                // Убираем сообщение об ошибке у поля для ввода пароля
                $('#valid_password_message').text('');
            }
        }
    });

    var confirm_password = $('input[name=confirm_password]');
    confirm_password.blur(function () {
        if (password.val() != confirm_password.val()) {
            $('input[type=submit]').attr('disabled', true); // Дезактивируем кнопку отправки
            $('#valid_confirm_password_message').text('Пароли не совпадают'); //Выводим сообщение об ошибке
        } else {
            // Убираем сообщение об ошибке у поля для ввода пароля
            $('#valid_confirm_password_message').text('');
            $('input[type=submit]').attr('disabled', false); //Активируем кнопку отправки
        }
    });
});
