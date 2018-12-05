<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once("dbconnect.php");//Добавляем файл подключения к БД
require_once("header.php");
include_once('avatar_download.php');
$login = $_SESSION["email"];
$password = $_SESSION["password"];
$id = $_SESSION["profile_id"];
$query_profile_login = $mysqli->query("SELECT profile.`profile_login`, profile.`friends`, info.`info_first_name`, info.`info_last_name`, info.`info_photo`, info.`info_descroption`, info.`info_city`, info.`info_link`  FROM profile INNER JOIN info ON (profile.`profile_id` = info.`profile_id`) WHERE profile.`profile_login` = '$login' AND profile.profile_pass = '$password'");
/*$query_friend = $mysqli->query("SELECT profile.`profile_login`, friend.`profile_id`, friend.`friend_status`  FROM profile INNER JOIN friend ON (profile.`profile_id` = friend.`profile_id`)  WHERE friend.friend_recive_id = '$id' AND friend.friend_status = '0'");
if (($row_friend = $query_friend->fetch_assoc()) != false) { //Если ошибок в запросе нет
  echo "пользователь " . $row_friend['profile_login'] . " хочет добавить вас в друзья";

}*/
if (($row = $query_profile_login->fetch_assoc()) != false) { //Если ошибок в запросе нет
    $full_name = $row['info_first_name'] . ' ' . $row['info_last_name'];
    $descroption = $row['info_descroption'];
    $link = $row['info_link'];
    $city = $row['info_city'];
    $photo = $row['info_photo'];
    ?>
  <main>
    <div class="user-img">
      <div class="user_photo">
        <img src="<?= $photo ?>" alt="user img">
      </div>
      <div class="download_photo">
        <div id="results"></div>
        <form method="post" enctype="multipart/form-data">
          <input type="file" name="file"  accept="image/*" class="label" value="fxv">
          <i class="fas fa-download"></i>
          <input type="submit" value="Загрузить фотографию" class="label">
        </form>
      </div>
    </div>
        <?php
        // если была произведена отправка формы
        if (isset($_FILES['file'])) {
            // проверяем, можно ли загружать изображение
            $check = can_upload($_FILES['file']);

            if ($check === true) {
                // загружаем изображение на сервер
                $photo_link = make_upload($_FILES['file']);
                echo "<strong>Файл успешно загружен!</strong>";
                $result_query_update = $mysqli->query("UPDATE `info` SET info_photo = '$photo_link' WHERE profile_id='$id'");
                echo "<script>window.location.href='https://myhomies.mcdir.ru/user_profile.php'</script>";

            } else {
                // выводим сообщение об ошибке
                echo "<strong>$check</strong>";
            }
        }
        ?>

    <div class="user-inf">
        <div class="user-inf_name">
          <p><?= $row['profile_login'] ?></p>
        </div>
        <div class="user-inf_edit-profile-button">
          <a href="form_edit_profile.php"><p><i class="fas fa-user-edit"></i>&nbsp;Редактировать профиль</p></a>
        </div>
      <div class="user-inf_descroption">
        <p><?php if(!empty($full_name)) {print "Имя, фамилия: " . $full_name;}?></p>
        <p><?php if(!empty($city)) {print "Город: " . $city;}?></p>
        <p><?php if(!empty($descroption )){ print "О себе: " . $descroption;}?></p>
        <p>
            <?php
            if(!empty($link)){
              print "Личный сайт: ";
              ?>
        </p>
        <a href="<?= $link ?>"><?= $link ?></a>
          <?php
            }
            ?>
      </div>
    </div>
  </main>

    <?php
    require_once("google_maps.php");
}
?>

