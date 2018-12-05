<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once("dbconnect.php"); //Добавляем файл подключения к БД
$_SESSION["error_messages"] = ''; //Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
$_SESSION["success_messages"] = '';//Объявляем ячейку для добавления успешных сообщений

if (isset($_POST["btn_submit_edit"]) && !empty($_POST["btn_submit_edit"])) {
    if (isset($_POST["first_name"])) {
        $first_name = trim($_POST["first_name"]); //Обрезаем пробелы с начала и с конца строки
        if (!empty($first_name)) { //Проверяем переменную на пустоту
            $first_name = htmlspecialchars($first_name, ENT_QUOTES);// Для безопасности, преобразуем специальные символы в HTML-сущности
        } else {
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваше имя</p>";// Сохраняем в сессию сообщение об ошибке.
            header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу регистрации
            header("Location: " . $address_site . "form_edit_profile.php");
            exit();
        }
    } else {
        // Сохраняем в сессию сообщение об ошибке.
        $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле с именем</p>";
        //Возвращаем пользователя на страницу регистрации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: " . $address_site . "form_edit_profile.php");
        exit();
    }
    if(isset($_POST["last_name"])){
        $last_name = trim($_POST["last_name"]);
        if(!empty($last_name)){
            $last_name = htmlspecialchars($last_name, ENT_QUOTES);
        }else{
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Вашу фамилию</p>";
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."form_edit_profile.php");
            exit();
        }
    }else{
        $_SESSION["error_messages"] .= "<p class='mesage_error'>Отсутствует поле с фамилией</p>";
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."form_edit_profile.php");
        exit();
    }
    $descroption = trim($_POST["descroption"]);
    $info_city = trim($_POST["info_city"]);
    $info_link = trim($_POST["info_link"]);
    $profile_id = $_SESSION['profile_id'];
    $result_query_insert = $mysqli->query("UPDATE `info` SET info_first_name = '$first_name', info_last_name = '$last_name', info_descroption = '$descroption', info_city = '$info_city', info_link = '$info_link' WHERE profile_id='$profile_id'");
    if (!$result_query_insert) {
        $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на обновление данных пользователя в БД</p>";
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: " . $address_site . "form_edit_profile.php");
        exit();
    }
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: ".$address_site."user_profile.php");
    exit();
} else {
    exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=" . $address_site . "> главную страницу </a>.</p>");
}