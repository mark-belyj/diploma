<?php
//Подключение шапки
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
          //Уничтожаем чтобы не появилось заново при обновлении страницы
          unset($_SESSION["error_messages"]);
      }
      if (isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])) {
          echo $_SESSION["success_messages"];
          //Уничтожаем чтобы не появилось заново при обновлении страницы
          unset($_SESSION["success_messages"]);
      }
      ?>
  </div>
<?php
//Проверяем, если пользователь не авторизован, то выводим форму авторизации,
//иначе выводим сообщение о том, что он уже авторизован
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"])) {
    ?>
  <div id="form">
    <form action="auth.php" method="post" name="form_auth">
      <div class="form_header">
        <h2>Форма авторизации</h2>
        <span>Введите ваши регистрационные данные для входа в ваш личный кабинет. </span>
      </div>
      <div class="form_content">
        <input type="email" name="email" required="required" placeholder="Email" class="input"><br>
        <span id="valid_email_message" class="mesage_error"></span>
        <input type="password" name="password" placeholder="минимум 6 символов" required="required" class="input">
        <span id="valid_password_message" class="mesage_error"></span>
        <p>
          <img src="captcha.php" alt="Изображение капчи"/> <br>
          <input type="text" name="captcha" placeholder="Проверочный код" class="input">
        </p>
      </div>
      <div class="form_footer">
        <input type="submit" name="btn_submit_auth" value="Войти" class="button">
        <a href="reset_password.php" class="button">Забыли пароль?</a>
      </div>
    </form>
  </div>
    <?php
} else {
    ?>
  <div id="authorized">
    <h2>Вы уже авторизованы</h2>
  </div>
    <?php
}
?>
<?php
//Подключение подвала
require_once("footer.php");
?>