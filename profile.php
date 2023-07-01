<?php
session_start();
if (!$_SESSION['user']) {
  header('Location: /');
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML lang="ru">

<HEAD>
  <META http-equiv="content-type" content="text/html; charset=utf-8">
  <META name="Профиль" content="Крылов Алексей">
  <META name="viewport" content="width=device-width, initial-scale=1.0">
  <LINK rel="preload" href="css/main6.css" as="style" />
  <LINK rel="stylesheet" type="text/css" href="css/main6.css">
  <LINK rel="shortcut icon" href="pic/header/teapot.ico" type="image/x-icon">
  <TITLE>Ваш профиль
  </TITLE>
</HEAD>

<BODY>
  <?php
  require_once 'header.php';
  ?>
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(92701746, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/92701746" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
  <NAV>
    <ul class="topmenu">
      <li><A href="/">Главная</A></li>
      <li><A href="orders.php">Заказы</A></li>
      <li>
        <A class="down">Категории</a>
        <ul class="submenu">
          <!-- Раскрывающийся список с выбором категории -->
          <li><A href="teapots.php">Чайники</A></li>
          <li><A href="cups.php">Чашки</A></li>
          <li><A href="teaset.php">Чайный сервиз</A></li>
      </li>
    </ul>
    </ul>
  </NAV>
  </HEADER>
  <form>
    <H2><?= $_SESSION['user']['surname'] ?> <?= $_SESSION['user']['name'] ?> <?= $_SESSION['user']['fatherhood'] ?></H2>
    <a href="#"><?= $_SESSION['user']['email'] ?></a>
    <a href="update.php?id=<?= $_SESSION['user']['Id_users'] ?>">Редактировать</a>
    <a href="php/logout.php" class="exit">Выход</a>
  </form>
  <?php
  require_once 'footer.php';
  ?>
</BODY>

</HTML>