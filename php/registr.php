<?php

session_start();
require_once '../php/connect.php';

$surname = strip_tags($_POST['surname']);
$name = strip_tags($_POST['name']);
$fatherhood = strip_tags($_POST['fatherhood']);
$email = strip_tags($_POST['email']);
$password = strip_tags($_POST['password']);
$password_confirm = strip_tags($_POST['password_confirm']);
$city = strip_tags($_POST['city']);
$address = strip_tags($_POST['address']);
$index = strip_tags($_POST['index']);

if ($password === $password_confirm) {

    $password = md5($password); //Возвращает хеш в виде 32-символьного шестнадцатеричного числа.

    mysqli_query($connect, "INSERT INTO `users` (`Id_users`,`surname`, `name`, `fatherhood`,`email`,`password`, `city`, `address`, `index`) VALUES (NULL,'$surname', '$name', '$fatherhood','$email','$password', '$city', '$address', '$index')");

    $_SESSION['message1'] = 'Регистрация прошла успешно!';
    header('Location: ../index.php#css-modal-target1');
} else {
    $_SESSION['message1'] = 'Пароли не совпадают';
    header('Location: ../index.php#css-modal-target1');
}
