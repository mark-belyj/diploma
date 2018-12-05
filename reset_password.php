<?php
header('Content-Type: text/html; charset=utf-8');
require_once("header.php");
?>
<link rel="stylesheet" href="styles/form.css">
<script src="js/email_validation.js"></script>
<script src="js/password_validation.js"></script>
<!-- Блок для вывода сообщений -->
<div class="block_for_messages">
    <?php
    if (isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])) {
        echo $_SESSION["error_messages"];
        unset($_SESSION["error_messages"]); //Уничтожаем ячейку error_messages, чтобы сообщения об ошибках не появились заново при обновлении страницы
    }
    if (isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])) {
        echo $_SESSION["success_messages"];
        unset($_SESSION["success_messages"]);//Уничтожаем ячейку success_messages, чтобы сообщения не появились заново при обновлении страницы
    }
    ?>
</div>
<?php
//Проверяем, если пользователь не авторизован, то выводим форму регистрации,
//иначе выводим сообщение о том, что он уже зарегистрирован
if ((!isset($_SESSION["email"]) && !isset($_SESSION["password"]))) {
    if (!isset($_GET["hidden_form"])) {
        ?>
      <div id="form">   
        <div class="center_block">
          <form action="send_link_reset_password.php" method="post" name="form_request_email">
            <div class="form_header">
              <h2>Восстановление пароля</h2>
              <p class="text_center mesage_error" id="valid_email_message"></p>
            </div>
            <div class="form_content">            
              <input type="email" name="email" required="required" class="input" placeholder="Email" maxlength="100">
              <p>
                <img src="captcha.php" alt="Капча"/> <br/>
                <input type="text" name="captcha" class="input" placeholder="Проверочный код" required="required">
              </p>
            </div>
            <div class="form_footer">
              <input type="submit" name="send" value="Восстановить" class="button">
            </div>
          </form>
        </div>
      </div>
        <?php
    }//закрываем условие hidden_form
} else {
    ?>
  <div id="authorized">
    <h2>Вы уже авторизованы</h2>
  </div>
    <?php
}
require_once("footer.php");
?>
