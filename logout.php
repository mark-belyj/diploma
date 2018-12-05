<?php
session_start();


unset($_SESSION["email"]);
unset($_SESSION["password"]);
unset($_SESSION["profile_id"]);
// Возвращаем пользователя на ту страницу, на которой он нажал на кнопку выход.
header("HTTP/1.1 301 Moved Permanently");
header("Location: ".$address_site. 'index.php' );

?>