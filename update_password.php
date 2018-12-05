<?php
header('Content-Type: text/html; charset=utf-8');
session_start();//Запускаем сессию
require_once("dbconnect.php");//Добавляем файл подключения к БД
if(isset($_POST["set_new_password"]) && !empty($_POST["set_new_password"])){
    if(isset($_POST['token']) && !empty($_POST['token'])){//Проверяем, если существует переменная token в глобальном массиве POST
        $token = $_POST['token'];
    }else{
        $_SESSION["error_messages"] = "<p class='mesage_error' ><strong>Ошибка!</strong> Отсутствует проверочный код ( Передаётся скрытно ).</p>";// Сохраняем в сессию сообщение об ошибке.
        header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу установки нового пароля
        header("Location: ".$address_site."set_new_password.php?email=$email&token=$token");
        exit();//Останавливаем  скрипт
    }
    if(isset($_POST['email']) && !empty($_POST['email'])){//Проверяем, если существует переменная email в глобальном массиве POST
        $email = $_POST['email'];
    }else{
        $_SESSION["error_messages"] = "<p class='mesage_error' ><strong>Ошибка!</strong> Отсутствует адрес электронной почты ( Передаётся скрытно ).</p>";// Сохраняем в сессию сообщение об ошибке.
        header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу установки нового пароля
        header("Location: ".$address_site."set_new_password.php?email=$email&token=$token");
        exit();//Останавливаем  скрипт
    }
    if(isset($_POST["password"])){
        $password = trim($_POST["password"]);//Обрезаем пробелы с начала и с конца строки
        if(isset($_POST["confirm_password"])){//Проверяем, совпадают ли пароли
            $confirm_password = trim($_POST["confirm_password"]);            //Обрезаем пробелы с начала и с конца строки
            if($confirm_password != $password){
                $_SESSION["error_messages"] = "<p class='mesage_error' >Пароли не совпадают</p>";// Сохраняем в сессию сообщение об ошибке.
                header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу установки нового пароля
                header("Location: ".$address_site."set_new_password.php?email=$email&token=$token");
                exit();//Останавливаем  скрипт
            }
        }else{
            $_SESSION["error_messages"] = "<p class='mesage_error' >Отсутствует поле для повторения пароля</p>";// Сохраняем в сессию сообщение об ошибке.
            header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу установки нового пароля
            header("Location: ".$address_site."set_new_password.php?email=$email&token=$token");
            exit();//Останавливаем  скрипт
        }
        if(!empty($password)){
            $password = htmlspecialchars($password, ENT_QUOTES);
            $password = md5($password."top_secret");//Шифруем папроль
        }else{
            $_SESSION["error_messages"] = "<p class='mesage_error' >Пароль не может быть пустым</p>";// Сохраняем в сессию сообщение об ошибке.
            header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу установки нового пароля
            header("Location: ".$address_site."set_new_password.php?email=$email&token=$token");
            exit();//Останавливаем  скрипт
        }
    }else{
        $_SESSION["error_messages"] = "<p class='mesage_error' >Отсутствует поле для ввода пароля</p>";// Сохраняем в сессию сообщение об ошибке.
        header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу установки нового пароля
        header("Location: ".$address_site."set_new_password.php?email=$email&token=$token");
        exit();//Останавливаем  скрипт
    }
    $query_update_password = $mysqli->query("UPDATE profile SET profile_pass='$password' WHERE profile_login='$email'");
    if(!$query_update_password){
        $_SESSION["error_messages"] = "<p class='mesage_error' >Возникла ошибка при изменении пароля.</p><p><strong>Описание ошибки</strong>: ".$mysqli->error."</p>";// Сохраняем в сессию сообщение об ошибке.
        header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу установки нового пароля
        header("Location: ".$address_site."set_new_password.php?email=$email&token=$token");
        exit();//Останавливаем  скрипт
    }else{
        require_once("header.php");//Подключение шапки
        echo '<h1 class="success_message text_center">Пароль успешно изменён!</h1>';//Выводим сообщение о том, что пароль установлен успешно.
        echo '<p class="text_center">Теперь Вы можете войти в свой аккаунт.</p>';
        require_once("footer.php");//Подключение подвала
    }
}else{
    exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=".$address_site."> главную страницу </a>.</p>");
}
?>
