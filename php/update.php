<?php
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');
//Обновление информации

/*
 * Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL)
 */

require_once '../php/connect.php';

/*
 * Создаем переменные со значениями, которые были получены с $_POST
 */
$Id_users = $_POST['Id_users'];
$surname = $_POST['surname']; //переменные переданные методом POST
$name = $_POST['name']; //переменные переданные методом POST
$fatherhood = $_POST['fatherhood']; //переменные переданные методом POST
$email = $_POST['email']; //переменные переданные методом POST
$password = $_POST['password']; //переменные переданные методом POST
$city = $_POST['city']; //переменные переданные методом POST
$address = $_POST['address']; //переменные переданные методом POST
$index = $_POST['index']; //переменные переданные методом POST
/*
 * Делаем запрос на изменение строки в таблице article
 */

mysqli_query($connect, "UPDATE `users` SET `surname` = '$surname', `name` = '$name', `fatherhood` = '$fatherhood', `email` = '$email', `password` = '$password', `city` = '$city', `address` = '$address', `index` = '$index' WHERE `users`.`Id_users` = $Id_users");

/*
 * Переадресация на главную страницу
 */
echo '<script>alert("Данные успешно обновленны.")
 window.location = "../profile.php";
 </script>';
