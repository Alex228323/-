<?php
session_start();
/*
     * Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL)
     */

require_once 'php/connect.php';

/*
     * Получаем ID продукта из адресной строки 
     */

$id = $_GET['id'];

/*
     * Делаем выборку строки с полученным ID выше
     */

$users = mysqli_query($connect, "SELECT * FROM `users` WHERE `Id_users` = '$id'");

/*
     * Преобразовывем полученные данные в нормальный массив
     * Используя функцию mysqli_fetch_assoc массив будет иметь ключи равные названиям столбцов в таблице
     */

$users = mysqli_fetch_assoc($users);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML lang="ru">

<HEAD>
  <META http-equiv="content-type" content="text/html; charset=utf-8">
  <META name="Профиль" content="Крылов Алексей">
  <META name="viewport" content="width=device-width, initial-scale=1.0">
  <LINK rel="stylesheet" type="text/css" href="css/main7.css">
  <LINK rel="shortcut icon" href="pic/header/teapot.ico" type="image/x-icon">
  <TITLE>Ваш профиль
  </TITLE>
</HEAD>

<BODY>
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(92701746, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/92701746" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
  <MAIN>
    <FORM action="php/update.php" method="post">
      <H2>Редактирование данных</H2>
      <input type="hidden" name="Id_users" value="<?= $users['Id_users'] ?>" placeholder="ID" required readonly>
      <input type="text" name="surname" value="<?= $users['surname'] ?>" placeholder="Имя" required>
      <input type="text" name="name" value="<?= $users['name'] ?>" placeholder="Фамилия" required>
      <input type="text" name="fatherhood" value="<?= $users['fatherhood'] ?>" placeholder="Отчество">
      <input type="text" name="email" value="<?= $users['email'] ?>" placeholder="Email" required>
      <input type="text" name="city" value="<?= $users['city'] ?>" placeholder="Город" required>
      <input type="text" name="address" value="<?= $users['address'] ?>" placeholder="Адрес">
      <input type="text" name="index" value="<?= $users['index'] ?>" placeholder="Почтовый индекс" required>
      <!-- поле ввода -->
      <button type="submit">Обновить</button><!-- кнопка для обновления данных -->
    </FORM>
  </MAIN>
</BODY>

</HTML>