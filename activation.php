<?php
header('Content-Type: text/html; charset=utf-8');
require_once("dbconnect.php");//Добавляем файл подключения к БД
if (isset($_GET['token']) && !empty($_GET['token'])) {//Проверяем, если существует переменная token в глобальном массиве GET
    $token = $_GET['token'];
} else {
    exit("<p><strong>Ошибка!!</strong> Отсутствует проверочный код.</p>");
}
if (isset($_GET['email']) && !empty($_GET['email'])) {//Проверяем, если существует переменная email в глобальном массиве GET
    $email = $_GET['email'];
} else {
    exit("<p><strong>Ошибка!</strong> Отсутствует адрес электронной почты.</p>");
}
/*//Удаляем пользователей с таблицы users, которые не подтвердили свою почту в течении сутки
$query_delete_users = $mysqli->query("DELETE FROM `profile` WHERE `profile_login_status` = 0 AND `profile_date_registration` < ( NOW() - INTERVAL 1 DAY )");
if(!$query_delete_users){
    exit("<p><strong>Ошибка!</strong> Сбой при удалении просроченного аккаунта. Код ошибки: ".$mysqli->errno."</p>");
}
//Удаляем пользователей из таблицы confirm_users, которые не подтвердили свою почту в течении сутки
$query_delete_confirm_users = $mysqli->query("DELETE FROM `confirm_profile` WHERE `confirm_profile_date_registration` < ( NOW() - INTERVAL 1 DAY)");
if(!$query_delete_confirm_users){
    exit("<p><strong>Ошибка!</strong> Сбой при удалении просроченного аккаунта(confirm). Код ошибки: ".$mysqli->errno."</p>");
}*/
$query_select_user = $mysqli->query("SELECT confirm_profile_token FROM confirm_profile WHERE confirm_profile_login = '$email'");//Делаем запрос на выборке токена из таблицы confirm_users
if (($row = $query_select_user->fetch_assoc()) != false) { //Если ошибок в запросе нет
    if ($query_select_user->num_rows == 1) { //Если такой пользователь существует
        if ($token == $row['confirm_profile_token']) {//Проверяем совпадает ли token
            $query_update_user = $mysqli->query("UPDATE `profile` SET `profile_login_status` = 1 WHERE `profile_login` = '" . $email . "'");//Обновляем статус почтового адреса
            if (!$query_update_user) {
                exit("<p><strong>Ошибка!</strong> Сбой при обновлении статуса пользователя. Код ошибки: " . $mysqli->errno . "</p>");
            } else {
                $query_delete = $mysqli->query("DELETE FROM `confirm_profile` WHERE `confirm_profile_login` = '" . $email . "'");    //Удаляем данные пользователя из временной таблицы confirm_users
                if (!$query_delete) {
                    exit("<p><strong>Ошибка!</strong> Сбой при удалении данных пользователя из временной таблицы. Код ошибки: " . $mysqli->errno . "</p>");
                } else {
                    require_once("header.php");    //Подключение шапки
                    echo '<h1 class="success_message text_center">Почта успешно подтверждена!</h1>';//Выводим сообщение о том, что почта успешно подтверждена.
                    echo '<p class="text_center">Теперь Вы можете войти в свой аккаунт.</p>';
                    require_once("footer.php");//Подключение подвала
                }

            }
// Завершение запроса обновления статуса почтового адреса
            //$query_update_user->close();
            //$query_delete->close(); // Завершение запроса удаления данных из таблицы confirm_users
        } else { //if($token == $row['token'])
            exit("<p><strong>Ошибка!</strong> Неправильный проверочный код.</p>");
        }
    } else { //if($query_select_user->num_rows == 1)
        exit("<p><strong>Ошибка!</strong> Такой пользователь не зарегистрирован </p>");
    }
} else { //if(($row = $query_select_user->fetch_assoc()) != false)
    exit("<p><strong>Ошибка!</strong> Сбой при выборе пользователя из БД. </p>");//Иначе, если есть ошибки в запросе к БД
}
// Завершение запроса выбора пользователя из таблицы users
//$query_select_user->close();
$mysqli->close();//Закрываем подключение к БД
?>

