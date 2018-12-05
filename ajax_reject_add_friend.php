<?php
require_once("dbconnect.php");//Добавляем файл подключения к БД
$my_id = $_GET['my_id'];
$send_id = $_GET['recive_id'];

$delete_request_add_to_friend = $mysqli->query("DELETE FROM `friend` WHERE friend_recive_id = '$my_id' AND friend_status = '0'");