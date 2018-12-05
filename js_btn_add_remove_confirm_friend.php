<?php ?>
<script> // запрос на добавления в друзья
$(function () {
    $('#add_to_friend').click(function () {
        var data = {my_id: "<?=$my_id?>", recive_id: "<?=$id_running?>"};
              $.get("<?= $_SESSION["address_site"] . "ajax_send_add_friend.php" ?>", data, success);
          });

    function success(forecastData) {
        alert("Запрос отправлен");

    }
});
</script>
  <script> // запрос на добавления в друзья
$(function () {
    $('#confirm_friend').click(function () {
        var data = {my_id: "<?=$my_id?>", recive_id: "<?=$id_running?>"};
              $.get("<?= $_SESSION["address_site"] . "ajax_confirm_add_friend.php" ?>", data, success);
          });

    function success(forecastData) {
        alert("Друг подтвержен");
    }
});
  </script>
  <script> // отклонить
$(function () {
    $('#reject_friend').click(function () {
        var data = {my_id: "<?=$my_id?>", recive_id: "<?=$id_running?>"};
              $.get("<?= $_SESSION["address_site"] . "ajax_reject_add_friend.php" ?>", data, success);
          });

    function success(forecastData) {
        alert("Запрос отклонен");
    }
});
  </script>

  <script> // удалить
$(function () {
    $('#delete_friend').click(function () {
        var data = {my_id: "<?=$my_id?>", recive_id: "<?=$id_running?>"};
              $.get("<?= $_SESSION["address_site"] . "delete_friend.php" ?>", data, success);
          });

    function success(forecastData) {
        alert("друг удален");
    }
});
  </script>
