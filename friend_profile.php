<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once("dbconnect.php");//Добавляем файл подключения к БД
require_once("header.php");
$login_running = $_GET['login'];
$id_running = $_GET['id'];
$my_id = $_SESSION['profile_id'];
// Запрос на получение информации о любом пользователе
$query_profile_login = $mysqli->query("SELECT profile.`profile_login`, profile.`friends`, info.`info_first_name`, info.`info_last_name`, info.`info_photo`, info.`info_descroption`, info.`info_city`, info.`info_link`, geolocation.`x`, geolocation.`y`, geolocation.`geolocation_marker_desc`, 	geolocation.`geolocation_date` FROM profile join info ON profile.profile_id = info.profile_id join geolocation ON info.profile_id = geolocation.profile_id WHERE profile.`profile_id` = '$id_running'");
if (($row = $query_profile_login->fetch_assoc()) != false) { //Если ошибок в запросе нет
    $full_name = $row['info_first_name'] . ' ' . $row['info_last_name'];
    $descroption = $row['info_descroption'];
    $link = $row['info_link'];
    $city = $row['info_city'];
    $photo = $row['info_photo'];
    $lat = $row['x'];
    $lng = $row['y'];
    $geo_head = $row['geolocation_marker_desc'] . ' ' . $row['info_last_name'];
    $geo_date = $row['geolocation_date'];
    require_once("js_btn_add_remove_confirm_friend.php");
    ?>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

  <main>
    <div class="user-img">
      <a href="#"><img src="<?= $photo ?>" alt="user img"></a>
    </div>
    <div class="user-inf">
      <div class="user-inf_name">
        <p><?= $row['profile_login'] ?></p>
      </div>

      <!--  // обработка вывода кнопок для добавления в друзья/удаления...-->
        <?php
        if ($my_id != $id_running) {
            if ($id_running == $row_request_for_friends["profile_id"]) { // когда я захожу на страницу того, кто кинул заявку
                $flag1 = 1;
                ?>
              <div class="user-inf_edit-profile-button">
                <a id="confirm_friend"><p><i class="fas fa-user-check"></i>&nbsp;подтвердить</p></a>
              </div>
              <br>
              <div class="user-inf_edit-profile-button">
                <a id="reject_friend"><p><i class="fas fa-user-minus"></i>&nbsp;отменить</p></a>
              </div>
                <?php
            }

            while ($row_friends = $select_friends->fetch_assoc()) {
                if ($id_running == $row_friends["profile_id"]) { // когда я захожу на странику к другу
                    ?>
                  <div class="user-inf_edit-profile-button">
                    <a id="delete_friend"><p><i class="fas fa-user-times"></i>&nbsp;удалить из друзей</p></a>
                  </div>
                    <?php
                    $flag2 = 1;
                    break;
                }
                ?>

                <?php
            }
            if ($flag1 != 1 && $flag2 != 1) {
                ?>
              <div class="user-inf_edit-profile-button">
                <a id="add_to_friend"><p><i class="fas fa-user-plus"></i>&nbsp; Отправить заявку Добавить в друзья</p>
                </a>
              </div>
                <?php
            }
        }


        ?>
      <div class="user-inf_descroption">
        <p><?php if (!empty($full_name)) {
                print "Имя, фамилия: " . $full_name;
            } ?></p>
        <p><?php if (!empty($city)) {
                print "Город: " . $city;
            } ?></p>
        <p><?php if (!empty($descroption)) {
                print "О себе: " . $descroption;
            } ?></p>
        <p>
            <?php
            if (!empty($link)){
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
    require_once("google_maps_friend.php");
    //require_once("google_maps.php");
    /*require_once("footer.php");*/
}
?>

