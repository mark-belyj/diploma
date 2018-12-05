<?php
session_start();
require_once("dbconnect.php");//Добавляем файл подключения к БД
$login = $_SESSION["email"];
// Запрос на получение всех пользователей
$all_users = $mysqli->query("SELECT `profile_login`, profile_id FROM profile WHERE profile_login_status = 1 AND profile_login != '$login'");
echo "Все пользователи: <br>";
while ($row_all_users = $all_users->fetch_assoc()) {
    echo $row_all_users['profile_login']; ?>
    <br>
    <?php
}
$all_users->close();