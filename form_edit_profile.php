<?php
header('Content-Type: text/html; charset=utf-8');
session_start();
require_once("dbconnect.php");//Добавляем файл подключения к БД
require_once("header.php");
$login = $_SESSION["email"];
$password = $_SESSION["password"];
$query_profile_login = $mysqli->query("SELECT profile.`profile_login`, profile.`friends`, info.`info_first_name`, info.`info_last_name`, info.`info_photo`, info.`info_descroption`, info.`info_city`, info.`info_link`  FROM profile INNER JOIN info ON (profile.`profile_id` = info.`profile_id`) WHERE profile.`profile_login` = '$login' AND profile.profile_pass = '$password'");
if (($row = $query_profile_login->fetch_assoc()) != false) { //Если ошибок в запросе нет
    $full_name = $row['info_first_name'] . ' ' . $row['info_last_name'];
    $descroption = $row['info_descroption'];
    $link = $row['info_link'];
    ?>
  <link rel="stylesheet" href="styles/form.css">
  <div class="content1">
    <div id="form">          
      <form action="edit_profile.php" method="post" name="form_register">
        <div class="form_header">
          <h2>Изменить данные</h2>  
        </div>
        <div class="form_content">
          <p>Имя:</p>
          <input type="text" name="first_name" required="required" class="input username"
                 value="<?=$row['info_first_name']?>">
          <p>Фамилия:</p>                        
          <input type="text" name="last_name" required="required" class="input" value="<?=$row['info_last_name']?>">                        
          <p>О себе:</p>
          <input type="text" name="descroption" class="input" value="<?=$descroption?>">  
          <p>Родной город:</p>                      
          <input type="text" name="info_city" class="input" value="<?=$row['info_city']?>">  
          <p>Личный сайт:</p>
          <input type="text" name="info_link" class="input" value="<?=$row['info_link']?>">  
        </div>
        <div class="form_footer">
          <input type="submit" name="btn_submit_edit" value="Изменить!" class="button">
        </div>
      </form>
    </div>
  </div>
    <?php
}

require_once("footer.php");
?>
