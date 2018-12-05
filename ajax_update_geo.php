<?php
require_once("dbconnect.php");//Добавляем файл подключения к БД
$id = $_GET['id'];
$x = (double)$_GET['x'];
$y = (double)$_GET['y'];
$result_query_insert = $mysqli->query("UPDATE `geolocation` SET geolocation_date = NOW(), x = '$x', y = '$y' WHERE profile_id='$id'");


//echo $x;
