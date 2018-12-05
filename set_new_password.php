<?php
header('Content-Type: text/html; charset=utf-8');
require_once("dbconnect.php");//Добавляем файл подключения к БД
if (isset($_GET['token']) && !empty($_GET['token'])) {//Проверяем, если существует переменная token в глобальном массиве GET
    $token = $_GET['token'];
} else {
    exit("<p><strong>Ошибка!</strong> Отсутствует проверочный код.</p>");
}
if (isset($_GET['email']) && !empty($_GET['email'])) {//Проверяем, если существует переменная email в глобальном массиве GET
    $email = $_GET['email'];
} else {
    exit("<p><strong>Ошибка!</strong> Отсутствует адрес электронной почты.</p>");
}
$query_select_user = $mysqli->query("SELECT profile_reset_password_token FROM `profile` WHERE `profile_login` = '" . $email . "'");//Делаем запрос на выборке токена из таблицы confirm_users
if (($row = $query_select_user->fetch_assoc()) != false) {//Если ошибок в запросе нет
    if ($query_select_user->num_rows == 1) {//Если такой пользователь существует
        if ($token == $row['profile_reset_password_token']) {//Проверяем совпадает ли token
            require_once("header.php");//Подключение шапки
            ?>
          <link rel="stylesheet" href="styles/form.css">
          <script src="js/password_validation.js"></script>
       <!--   <script type="text/javascript">
              $(document).ready(function () {
                  "use strict";
                  //================ Прооверка паролей ==================
                  var password = $('input[name=password]');
                  var confirm_password = $('input[name=confirm_password]');

                  password.blur(function () {
                      if (password.val() != '') {
                          //Если длина введённого пароля меньше шести символов, то выводим сообщение об ошибке
                          if (password.val().length < 6) {
                              //Выводим сообщение об ошибке
                              $('#valid_password_message').text('Минимальная длина пароля 6 символов');
                              //проверяем, если пароли не совпадают, то выводим сообщение об ошибке
                              if (password.val() !== confirm_password.val()) {
                                  //Выводим сообщение об ошибке
                                  $('#valid_confirm_password_message').text('Пароли не совпадают');
                              }
                              // Дезактивируем кнопку отправки
                              $('input[type=submit]').attr('disabled', true);

                          } else {
                              //Иначе, если длина первого пароля больше шести символов, то мы также проверяем, если они  совпадают.
                              if (password.val() !== confirm_password.val()) {
                                  //Выводим сообщение об ошибке
                                  $('#valid_confirm_password_message').text('Пароли не совпадают');
                                  // Дезактивируем кнопку отправки
                                  $('input[type=submit]').attr('disabled', true);
                              } else {
                                  // Убираем сообщение об ошибке у поля для ввода повторного пароля
                                  $('#valid_confirm_password_message').text('');
                                  //Активируем кнопку отправки
                                  $('input[type=submit]').attr('disabled', false);
                              }
                              // Убираем сообщение об ошибке у поля для ввода пароля
                              $('#valid_password_message').text('');
                          }
                      } else {
                          $('#valid_password_message').text('Введите пароль');
                      }
                  });

                  confirm_password.blur(function () {
                      //Если пароли не совпадают
                      if (password.val() !== confirm_password.val()) {
                          //Выводим сообщение об ошибке
                          $('#valid_confirm_password_message').text('Пароли не совпадают');
                          // Дезактивируем кнопку отправки
                          $('input[type=submit]').attr('disabled', true);
                      } else {
                          //Иначе, проверяем длину пароля
                          if (password.val().length > 6) {
                              // Убираем сообщение об ошибке у поля для ввода пароля
                              $('#valid_password_message').text('');
                              //Активируем кнопку отправки
                              $('input[type=submit]').attr('disabled', false);
                          }
                          // Убираем сообщение об ошибке у поля для ввода повторного пароля
                          $('#valid_confirm_password_message').text('');
                      }
                  });
              });
          </script>-->
          <div id="form">         
            <div class="center_block">
              <form action="update_password.php" method="post">
                <div class="form_header">
                  <h2>Установка нового пароля</h2>
                </div>
                <div class="form_content">  
                  <input type="password" name="password" placeholder="Пароль минимум 6 символов" required="required"
                         class="input password">          
                  <span id="valid_password_message" class="mesage_error"></span>
                  <input type="password" name="confirm_password" placeholder="минимум 6 символов" required="required"
                         class="input password"/><br/>
                  <span id="valid_confirm_password_message" class="mesage_error"></span>
                  <input type="hidden" name="token" value="<?= $token ?>">
                  <input type="hidden" name="email" value="<?= $email ?>">
                </div>
                <div class="form_footer">
                  <input type="submit" name="set_new_password" value="Изменить пароль" class="button"/>
                </div>
              </form>
            </div>
          </div>
            <?php
            require_once("footer.php");//Подключение подвала
        } else {
            exit("<p><strong>Ошибка!</strong> Неправильный проверочный код.</p>");
        }
    } else {
        exit("<p><strong>Ошибка!</strong> Такой пользователь не зарегистрирован </p>");
    }
} else {
    exit("<p><strong>Ошибка!</strong> Сбой при выборе пользователя из БД. </p>");//Иначе, если есть ошибки в запросе к БД
}
$query_select_user->close();// Завершение запроса выбора пользователя из таблицы users
$mysqli->close();//Закрываем подключение к БД
?>