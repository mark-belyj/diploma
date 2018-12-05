<?php
require_once("dbconnect.php");//Добавляем файл подключения к БД
$my_id = $_GET['my_id'];
$recive_id = $_GET['recive_id'];

$delete_friend = $mysqli->query("DELETE FROM `friend` WHERE (`friend_recive_id` = '$my_id' AND `profile_id` = '$recive_id' AND friend_status = '1')");
$delete_friend2 = $mysqli->query("DELETE FROM `friend` WHERE (`friend_recive_id` = '$recive_id' AND `profile_id` ='$my_id' AND friend_status = '1')");


