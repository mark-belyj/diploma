<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once("dbconnect.php");//Добавляем файл подключения к БД
require_once("header.php");

$login = $_SESSION["email"];
$password = $_SESSION["password"];
$id = $_SESSION["profile_id"];
?>
<script src="js/ajax_search_friends.js"></script>
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

<div class="friends-main">
  <div class="container-search_users">
    <form id="form_search_users" method="POST" action="javascript:void(null);" onsubmit="call()" class="container-2">
      <input type="search" class="input-search" name="name" placeholder="Найти друга..." required/>
      <button type="submit" id="button-search"><i class="fa fa-search fa-fw"></i></button>
    </form>
    </div>
  <div id="results"></div>



  <div class="requests-friend">
      <?php
      if ($size_request_for_friends != 0) {
          ?>
        <p>Заявки в друзья: </p>
        <a
          href="<?= $_SESSION["address_site"] ?>friend_profile.php?login=<?= $row_request_for_friends['profile_login'] ?>&id=<?= $row_request_for_friends['profile_id'] ?>"><img src="<?=$row_request_for_friends['info_photo']?>" alt="photo" style="height: 100px" width="100px" class="img_user"></a>

        <a
          href="<?= $_SESSION["address_site"] ?>friend_profile.php?login=<?= $row_request_for_friends['profile_login'] ?>&id=<?= $row_request_for_friends['profile_id'] ?>" class="link_user"><?= $row_request_for_friends['profile_login'] ?></a>
      <?php } ?>
  </div>
  <br>




  <div class="container-friends">
      <p>Друзья: </p>
      <?php // запрос на получения друзей находится в хэдере
      while ($row_friends = $select_friends->fetch_assoc()) {

          ?>
        <a
          href="<?= $_SESSION["address_site"] ?>friend_profile.php?login=<?= $row_friends['profile_login'] ?>&id=<?= $row_friends['profile_id'] ?>"><img src="<?= $row_friends['info_photo'] ?>" alt="logo of <?= $row_friends['profile_login'] ?>"
                                                                                                                                                         style="height: 100px"
                                                                                                                                                         width="100px"></a>
        <a
          href="<?= $_SESSION["address_site"] ?>friend_profile.php?login=<?= $row_friends['profile_login'] ?>&id=<?= $row_friends['profile_id'] ?>" class="link_user"><?= $row_friends['profile_login'] ?></a>

        <br>
          <?php
      }
      ?>

  </div>


</div>

<?php /*require_once("select_all_users.php");  */ ?><!-- // вывести всех пользователей-->
