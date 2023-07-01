<?php

session_start();
require_once '../php/connect.php';

$email = strip_tags($_POST['email']);
$password = strip_tags(md5($_POST['password']));

$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
if (mysqli_num_rows($check_user) > 0) {

    $user = mysqli_fetch_assoc($check_user);

    $_SESSION['user'] = [
        "Id_users" => $user['Id_users'],
        "surname" => $user['surname'],
        "name" => $user['name'],
        "fatherhood" => $user['fatherhood'],
        "email" => $user['email'],
        "password" => $user['password'],
        "city" => $user['city'],
        "address" => $user['address'],
        "index" => $user['index']
    ];

    header('Location: ../profile.php');
} else {
    $_SESSION['message'] = 'Не верный логин или пароль';
    header('Location: ../index.php#css-modal-target');
}
