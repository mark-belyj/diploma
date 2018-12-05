<?php
require_once("dbconnect.php");//Добавляем файл подключения к БД
$my_id = $_GET['my_id'];
$recive_id = $_GET['recive_id'];

$delete_request_friend = $mysqli->query("DELETE FROM `friend` WHERE (friend_recive_id = '$my_id' AND friend_status = '0') ");

$add_friend = $mysqli->query("INSERT INTO `friend` (friend.profile_id, friend.friend_recive_id, friend.friend_status) VALUES ('".$my_id."', '".$recive_id."', '1')");
$add_friend2 = $mysqli->query("INSERT INTO `friend` (friend.profile_id, friend.friend_recive_id, friend.friend_status) VALUES ('".$recive_id."', '".$my_id."', '1')");
