<?php
require_once("dbconnect.php");//Добавляем файл подключения к БД
$my_id = $_GET['my_id'];
$recive_id = $_GET['recive_id'];

$insert_request_for_friends = $mysqli->query("INSERT INTO `friend` (friend.profile_id, friend.friend_recive_id) VALUES ('".$my_id."', '".$recive_id."')");
