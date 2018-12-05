<?php
header('Content-Type: text/html; charset=utf-8');
session_start();//Запускаем сессию
require_once("dbconnect.php");//Добавляем файл подключения к БД
$_SESSION["error_messages"] = '';//Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
$_SESSION["success_messages"] = '';//Объявляем ячейку для добавления успешных сообщений
/*
    Проверяем была ли отправлена форма, то есть была ли нажата кнопка  Войти. Если да, то идём дальше, если нет, то выведем пользователю сообщение об ошибке, о том что он зашёл на эту страницу напрямую.
*/
if(isset($_POST["btn_submit_auth"]) && !empty($_POST["btn_submit_auth"])){//Проверяем полученную капчу
    if(isset($_POST["captcha"])){//Обрезаем пробелы с начала и с конца строки
        $captcha = trim($_POST["captcha"]);
        if(!empty($captcha)){//Сравниваем полученное значение с значением из сессии.s
            if(($_SESSION["rand"] != $captcha) && ($_SESSION["rand"] != "")){// Если капча не верна, то возвращаем пользователя на страницу авторизации, и там выведем ему сообщение об ошибке что он ввёл неправильную капчу.
                $error_message = "<p class='mesage_error'><strong>Ошибка!</strong> Вы ввели неправильную капчу </p>";// Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] = $error_message;//Возвращаем пользователя на страницу авторизации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."form_auth.php");
                exit();
            }
        }else{
            $error_message = "<p class='mesage_error'><strong>Ошибка!</strong> Поле для ввода капчи не должна быть пустой. </p>";    // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] = $error_message;//Возвращаем пользователя на страницу авторизации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."form_auth.php");
            exit();
        }
        //Место для обработки почтового адреса
        $email = trim($_POST["email"]);//Обрезаем пробелы с начала и с конца строки
        if(isset($_POST["email"])){
            if(!empty($email)){//Проверяем формат полученного почтового адреса с помощью регулярного выражения
                $email = htmlspecialchars($email, ENT_QUOTES);
                $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";//Если формат полученного почтового адреса не соответствует регулярному выражению
                if( !preg_match($reg_email, $email)){// Сохраняем в сессию сообщение об ошибке.
                    $_SESSION["error_messages"] .= "<p class='mesage_error' >Вы ввели неправильный email</p>";
                    header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу авторизации
                    header("Location: ".$address_site."form_auth.php");
                    exit();
                }
            }else{
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Поле для ввода почтового адреса(email) не должна быть пустой.</p>";                // Сохраняем в сессию сообщение об ошибке.
                header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу регистрации
                header("Location: ".$address_site."form_register.php");
                exit();
            }
        }else{
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Отсутствует поле для ввода Email</p>";// Сохраняем в сессию сообщение об ошибке.
            header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу авторизации
            header("Location: ".$address_site."form_auth.php");
            exit();
        }
        if(isset($_POST["password"])){// Место для обработки пароля
            $password = trim($_POST["password"]);//Обрезаем пробелы с начала и с конца строки
            if(!empty($password)){
                $password = htmlspecialchars($password, ENT_QUOTES);
                $password = md5($password."top_secret");//Шифруем пароль
            }else{
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Укажите Ваш пароль</p>";// Сохраняем в сессию сообщение об ошибке.
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."form_auth.php");
                exit();
            }
        }else{
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Отсутствует поле для ввода пароля</p>";// Сохраняем в сессию сообщение об ошибке.
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."form_auth.php");
            exit();
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
        //Запрос в БД на выборке пользователя.
        $result_query_select = $mysqli->query("SELECT `profile_login`, `profile_login_status`, `profile_id` FROM `profile` WHERE profile_login = '".$email."' AND profile_pass = '".$password."'");
        if(!$result_query_select){
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Ошибка запроса на выборке пользователя из БД</p>";// Сохраняем в сессию сообщение об ошибке.
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."form_auth.php");
            exit();
        }else{
            if($result_query_select->num_rows == 1){//Проверяем, если в базе нет пользователя с такими данными, то выводим сообщение об ошибке
                while(($row = $result_query_select->fetch_assoc()) !=false){//Проверяем, подтвержден ли указанный email
                    if((int)$row["profile_login_status"] == 0){//Если email не подтверждён
                        $_SESSION["error_messages"] = "<p class='mesage_error' >Вы зарегистрированы, но, Ваш почтовый адрес не подтверждён. Для подтверждения почты перейдите по ссылке из письма, которую получили после регистрации.</p>
                <p><strong>Внимание!</strong> Ссылка для подтверждения почты, действительна 24 часа с момента регистрации. Если Вы не подтвердите Ваш email в течении этого времени, то Ваш аккаунт будет удалён.</p>";// Сохраняем в сессию сообщение об ошибке.
                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$address_site."form_auth.php");
                        exit();
                    }else{
                        //место для добавления данных в сессию
                        // Если введенные данные совпадают с данными из базы, то сохраняем логин и пароль в массив сессий.
                        $_SESSION['profile_id'] = $row['profile_id'];
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;

                        header("HTTP/1.1 301 Moved Permanently");
                        header("Location: ".$address_site."user_profile.php");
                        exit();
                    }
                }
            }else{
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Неправильный логин и/или пароль</p>";// Сохраняем в сессию сообщение об ошибке.
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: ".$address_site."form_auth.php");
                exit();
            }
        }
    }else{
        exit("<p><strong>Ошибка!</strong> Отсутствует проверочный код, то есть код капчи. Вы можете перейти на <a href=".$address_site."> главную страницу </a>.</p>");//Если капча не передана
    }
}else{
    exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=".$address_site."> главную страницу </a>.</p>");
}

