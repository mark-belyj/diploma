<?php
require_once("header.php");
?>
  <link rel="stylesheet" href="styles/form.css">
  <script src="js/email_validation.js"></script>
  <script src="js/password_validation.js"></script>
  <!-- Блок для вывода сообщений -->
  <div class="block_for_messages">
      <?php
      //Если в сессии существуют сообщения об ошибках, то выводим их
      if (isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])) {
          echo $_SESSION["error_messages"];
          //Уничтожаем чтобы не выводились заново при обновлении страницы
          unset($_SESSION["error_messages"]);
      }
      //Если в сессии существуют радостные сообщения, то выводим их
      if (isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])) {
          echo $_SESSION["success_messages"];
          //Уничтожаем чтобы не выводились заново при обновлении страницы
          unset($_SESSION["success_messages"]);
      }
      ?>
  </div>
   
<?php
//Проверяем, если пользователь не авторизован, то выводим форму регистрации,
//иначе выводим сообщение о том, что он уже зарегистрирован
if((!isset($_SESSION["email"]) && !isset($_SESSION["password"]))) {

    if(!isset($_GET["hidden_form"])){
        ?>
  <div class="user-icon"></div>
  <div class="pass-icon"></div>
  <div id="form">          
    <form action="register.php" method="post" name="form_register">
      <div class="form_header">
        <h2>Форма регистрации</h2>  
        <span>Введите ваши регистрационные данные для входа в ваш личный кабинет. </span>
      </div>
      <div class="form_content">            
        <input type="text" name="first_name" required="required" class="input username"
               placeholder="Имя">                        
        <input type="text" name="last_name" required="required" class="input" placeholder="Фамилия">                        
        <input type="email" name="email" required="required" class="input" placeholder="Email" maxlength="100">
        <p class="note_text">Укажите правильный Email, так как на нём будет выслано сообщение для подтверждения почты.</p>
        <span id="valid_email_message" class="mesage_error"></span>                        
        <input type="password" name="password" placeholder="Пароль минимум 6 символов" required="required"
               class="input password">
        <span id="valid_password_message" class="mesage_error"></span>                      
        <input type="password" name="confirm_password" placeholder="минимум 6 символов" required="required"
               class="input password"/><br/>
        <span id="valid_confirm_password_message" class="mesage_error"></span>
        <p>
          <img src="captcha.php" alt="Капча"/>
          <input type="text" name="captcha" class="input" placeholder="Проверочный код" required="required">
        </p>                        
      </div>
      <div class="form_footer">
        <input type="submit" name="btn_submit_register" value="Зарегистрироватся!" class="button">
      </div>
    </form>
  </div>  

  <script type="text/javascript">
      $(document).ready(function () {
          $(".username").focus(function () {
              $(".user-icon").css("left", "-48px");
          });
          $(".username").blur(function () {
              $(".user-icon").css("left", "0px");
          });

          $(".password").focus(function () {
              $(".pass-icon").css("left", "-48px");
          });
          $(".password").blur(function () {
              $(".pass-icon").css("left", "0px");
          });
      });
  </script> 

        <?php
    }//закрываем условие hidden_form

}else{
    //Иначе, если пользователь уже авторизирован, то выводим этот блок
    ?>
  <div id="authorized">
    <h2>Вы уже зарегистрированы</h2>
  </div>
    <?php
}

//Подключение подвала
require_once("footer.php");
?>