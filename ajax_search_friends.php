<?php
require_once("dbconnect.php");//Добавляем файл подключения к БД
$search_name = "{$_POST[name]}";
session_start();
$login = $_SESSION["email"];
$password = $_SESSION["password"];
$queryz = $mysqli->query("SELECT profile.`profile_login`, profile.profile_id, info.info_photo  FROM profile INNER JOIN info ON (profile.`profile_id` = info.`profile_id`) WHERE  profile.profile_login_status = 1 AND profile.profile_login != '$login' AND profile.profile_login LIKE ('%$search_name%')");

$i = 0;
while ($row = $queryz->fetch_assoc()) {
    $i++;
    ?>
<a href="https://myhomies.mcdir.ru/friend_profile.php?id=<?=$row['profile_id']?>&login=<?=$row['profile_login']?> ">
  <img src="<?=$row['info_photo']?>" alt="photo" style="width: 100px" height="100px"></a>

    <a href="https://myhomies.mcdir.ru/friend_profile.php?id=<?=$row['profile_id']?>&login=<?=$row['profile_login']?> " class="link_user">
      <?php
      echo $row['profile_login'];
      ?>
    </a>



  <br>
    <?php
}


$queryz->close();


?>