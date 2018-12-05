<?php
header('Content-Type: text/html; charset=utf-8');
session_start(); //Запускаем сессию
require_once("dbconnect.php"); //Добавляем файл подключения к БД
$_SESSION["error_messages"] = '';//Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
$_SESSION["success_messages"] = ''; //Объявляем ячейку для добавления успешных сообщений
if(isset($_POST["send"])){ //Если кнопка Восстановить была нажата
    if(isset($_POST["captcha"])){ //Проверяем, отправлена ли капча
        $captcha = trim($_POST["captcha"]);//Обрезаем пробелы с начала и с конца строки
        if(!empty($captcha)){
            if(($_SESSION["rand"] != $captcha) && ($_SESSION["rand"] != "")){ //Сравниваем полученное значение со значением из сессии.
                // Если капча не верна, то возвращаем пользователя на страницу восстановления пароля, и там выведем ему сообщение об ошибке что он ввёл неправильную капчу.
                $_SESSION["error_messages"] =  "<p class='mesage_error'><strong>Ошибка!</strong> Вы ввели неправильную капчу </p>";// Сохраняем в сессию сообщение об ошибке.
                header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу восстановления пароля
                header("Location: ".$address_site."reset_password.php");
                exit();//Возвращаем пользователя на страницу восстановления пароля
            }
        }else{
            $_SESSION["error_messages"] = "<p class='mesage_error'><strong>Ошибка!</strong> Поле для ввода капчи не должна быть пустой. </p>";// Сохраняем в сессию сообщение об ошибке.
            header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу восстановления пароля
            header("Location: ".$address_site."reset_password.php");
            exit();//Останавливаем скрипт
        }
        if(isset($_POST["email"])){//Обрабатываем полученный почтовый адрес
            $email = trim($_POST["email"]);//Обрезаем пробелы с начала и с конца строки
            if(!empty($email)){
                $email = htmlspecialchars($email, ENT_QUOTES);
                $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";                //Проверяем формат полученного почтового адреса с помощью регулярного выражения
                if( !preg_match($reg_email, $email)){ //Если формат полученного почтового адреса не соответствует регулярному выражению
                    $_SESSION["error_messages"] = "<p class='mesage_error' >Вы ввели неправильный email</p>"; // Сохраняем в сессию сообщение об ошибке.
                    header("HTTP/1.1 301 Moved Permanently"); //Возвращаем пользователя на страницу восстановления пароля
                    header("Location: ".$address_site."reset_password.php");
                    exit(); //Останавливаем скрипт
                }
            }else{
                $_SESSION["error_messages"] = "<p class='mesage_error' > <strong>Ошибка!</strong> Поле для ввода почтового адреса(email) не должна быть пустой.</p>"; // Сохраняем в сессию сообщение об ошибке.
                header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу восстановления пароля
                header("Location: ".$address_site."reset_password.php");
                exit();//Останавливаем скрипт
            }
        }else{
            $_SESSION["error_messages"] = "<p class='mesage_error' > <strong>Ошибка!</strong> Отсутствует поле для ввода Email</p>";// Сохраняем в сессию сообщение об ошибке.
            header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу восстановления пароля
            header("Location: ".$address_site."reset_password.php");
            exit();//Останавливаем скрипт
        }
        $result_query_select = $mysqli->query("SELECT `profile_login_status` FROM `profile` WHERE `profile_login` = '".$email."'");
        if(!$result_query_select){
            $_SESSION["error_messages"] = "<p class='mesage_error' > Ошибка запроса на выборки пользователя из БД</p>";// Сохраняем в сессию сообщение об ошибке.
            header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу восстановления пароля
            header("Location: ".$address_site."reset_password.php");
            exit();//Останавливаем скрипт
        }else{
            if($result_query_select->num_rows == 1){//Проверяем, если в базе нет пользователя с такими данными, то выводим сообщение об ошибке
                while(($row = $result_query_select->fetch_assoc()) !=false){//Проверяем, подтвержден ли указанный email
                    if((int)$row["profile_login_status"] === 0){//Проверяем, подтвержден ли указанный email
                        $_SESSION["error_messages"] = "<p class='mesage_error' ><strong>Ошибка!</strong> Вы не можете восстановить свой пароль, потому что указанный адрес электронной почты $email не подтверждён. </p><p>Для подтверждения почты перейдите по ссылке из письма, которую получили после регистрации.</p><p><strong>Внимание!</strong> Ссылка для подтверждения почты, действительна 24 часа с момента регистрации. Если Вы не подтвердите Ваш email в течении этого времени, то Ваш аккаунт будет удалён.</p>";//Проверяем, подтвержден ли указанный email
                        header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу восстановления пароля
                        header("Location: ".$address_site."reset_password.php");
                        exit();//Останавливаем скрипт

                    }else{
                        $token=md5($email.time());//Составляем зашифрованный и уникальный token
                        $query_update_token = $mysqli->query("UPDATE profile SET profile_reset_password_token ='$token' WHERE profile_login='$email'");//Сохраняем токен в БД
                        if(!$query_update_token){
                            $_SESSION["error_messages"] = "<p class='mesage_error' >Ошибка сохранения токена</p><p><strong>Описание ошибки</strong>: ".$mysqli->error."</p>"; // Сохраняем в сессию сообщение об ошибке.
                            header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу восстановления пароля
                            header("Location: ".$address_site."reset_password.php");
                            exit();//Останавливаем  скрипт
                        }else{
                            $link_reset_password = $address_site."set_new_password.php?email=$email&token=$token";//Составляем ссылку на страницу установки нового пароля.
                            $subject = "Восстановление пароля от сайта ".$_SERVER['HTTP_HOST'];//Составляем заголовок письма
                            $subject = "=?utf-8?B?".base64_encode($subject)."?=";//Устанавливаем кодировку заголовка письма и кодируем его
                            $message = 'Здравствуйте! <br/> <br/> Для восстановления пароля от сайта <a href="http://'.$_SERVER['HTTP_HOST'].'"> '.$_SERVER['HTTP_HOST'].' </a>, перейдите по этой <a href="'.$link_reset_password.'">ссылке</a>.';//Составляем тело сообщения
                            //Составляем дополнительные заголовки для почтового сервиса mail.ru
                            //Переменная $email_admin, объявлена в файле dbconnect.php
                            $headers = "FROM: $email_admin\r\nReply-to: $email_admin\r\nContent-type: text/html; charset=utf-8\r\n";
                            if(mail($email, $subject, $message, $headers)){//Отправляем сообщение с ссылкой на страницу установки нового пароля и проверяем отправлена ли она успешно или нет.
                                $_SESSION["success_messages"] = "<p class='success_message' >Ссылка на страницу установки нового пароля, была отправлена на указанный E-mail ($email) </p>";
                                header("HTTP/1.1 301 Moved Permanently");//Отправляем пользователя на страницу восстановления пароля и убираем форму для ввода email
                                header("Location: ".$address_site."reset_password.php?hidden_form=1");
                                exit();
                            }else{
                                $_SESSION["error_messages"] = "<p class='mesage_error' >Ошибка при отправлении письма на почту ".$email.", с сылкой на страницу установки нового пароля. </p>";
                                header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу восстановления пароля
                                header("Location: ".$address_site."reset_password.php");
                                exit();//Останавливаем скрипт
                            }
                        }
                    } // if($row["email_status"] === 0)
                } // End while
            }else{
                $_SESSION["error_messages"] = "<p class='mesage_error' ><strong>Ошибка!</strong> Такой пользователь не зарегистрирован</p>";// Сохраняем в сессию сообщение об ошибке.
                header("HTTP/1.1 301 Moved Permanently");//Возвращаем пользователя на страницу восстановления пароля
                header("Location: ".$address_site."reset_password.php");
                exit();//Останавливаем скрипт
            }
        }
    }else{ //if(isset($_POST["captcha"]))
        exit("<p><strong>Ошибка!</strong> Отсутствует проверочный код, то есть код капчи. Вы можете перейти на <a href=".$address_site."> главную страницу </a>.</p>");//Если капча не передана
    }
}else{ //if(isset($_POST["send"]))
    exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=".$address_site."> главную страницу </a>.</p>");
}
?>