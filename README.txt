dbconnect.php - Подключение к базе данный через MySQLi
header.php - шапка
footer.php - подвал
form_register.php -  страница с формой регистрации
form_auth.php - страница с формой авторизации
captcha.php -  генерирует капчу.
register.php - после регистрации форму мы отправляем на обработку файлу register.php
auth.php
logout.php - ссылку выхода с сайта ведет на logout.php


register - 150 string
     if(!empty($password)){
               // $password = htmlspecialchars($password, ENT_QUOTES);
                //Шифруем папроль
               // $password = md5($password."top_secret");