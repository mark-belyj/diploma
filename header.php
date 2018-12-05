<?php
session_start();
require_once("dbconnect.php");//Добавляем файл подключения к БД
$_SESSION["address_site"] = 'https://myhomies.mcdir.ru/';
$my_id = $_SESSION["profile_id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
  <title>GeoHomie</title>
  <link rel="stylesheet" href="styles/reset.css">
  <link rel="stylesheet" href="styles/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link rel="shortcut icon" href="/images/shortcut_logo2.gif" type="image/gif">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css"
        integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
</head>
<body>
<div id="wrapper">
  <header>
    <div class="all-logo">
      <div class="logo">
        <a href="<?= $_SESSION["address_site"] ?>"><img src="images/logo.gif"></a>
      </div>
      <div class="logo-name">
        <a href="<?= $_SESSION["address_site"] ?>">Geo<span class="logo-name-span">Homie</span></a>
      </div>
    </div>

      <?php
      if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) { //Проверяем авторизован ли пользователь
          // если нет, то выводим блок с ссылками на страницу регистрации и авторизации
          ?>
        <nav>
          <a href="form_auth.php" class="nav"><i class="fas fa-sign-in-alt"></i>&nbsp; Авторизация</a>
          <a href="form_register.php" class="nav"><i class="fas fa-edit"></i>&nbsp;Регистрация</a>
        </nav>
        <div id="nav_about">
          <a href="<?= $_SESSION["address_site"] ?>" class="nav_about" name="btn_exit"><i
              class="fas fa-info-circle"></i>&nbsp;О нас</a>
        </div>
          <?php
      } else { //Если пользователь авторизован, то выводим ссылку Выход

          ?>
        <nav>

          <a href="user_profile.php" class="nav"><i class="fas fa-home"></i>&nbsp; Моя страница</a>

            <?php
            // Запрос на заявку в друзья
            $select_request_for_friends = $mysqli->query("SELECT profile.`profile_login`, friend.`profile_id`, friend.`friend_status`, info.info_photo  FROM profile INNER JOIN friend ON (profile.`profile_id` = friend.`profile_id`) INNER JOIN info ON (friend.`profile_id` = info.`profile_id`) WHERE friend.friend_recive_id = '$my_id' AND friend.friend_status = '0'");
            if (($row_request_for_friends = $select_request_for_friends->fetch_assoc()) != false) {
            } //Если ошибок в запросе нет
            $size_request_for_friends = $mysqli->affected_rows;
            if ($size_request_for_friends != 0) {
                ?>

                <a href="friends.php" class="nav"><i class="fas fa-user-plus"></i>&nbsp;
                  Друзья<span>(+<?= $size_request_for_friends ?>)</span></a>

                <?php
            } else { ?>

                <a href="friends.php" class="nav"><i class="fas fa-users"></i>&nbsp; Друзья</a>


                <?php
            }
            ?>

            <a href="<?= $_SESSION["address_site"] ?>" class="nav" name="btn_exit"><i
                class="fas fa-info-circle"></i>&nbsp; О нас</a>
        </nav>
        <div id="nav_about">
          <a href="/logout.php" class="nav_about" name="btn_exit"><i class="fas fa-power-off"></i>&nbsp; Выход</a>
        </div>

          <?php
      }
      ?>
      <?php
      // запрос на получение друзей
      $select_friends = $mysqli->query("SELECT friend.`profile_id`, friend.`friend_recive_id`	, info.`info_photo`, profile.`profile_login` FROM friend INNER JOIN info ON friend.`profile_id` = info.`profile_id` INNER JOIN  profile ON info.profile_id = profile.profile_id WHERE friend_status = 1 AND friend.friend_recive_id = '$my_id'");
      ?>
    </nav>
  </header>