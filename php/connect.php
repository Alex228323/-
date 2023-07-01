<?php

/*
 * Подключаемся к базе данных с помощью функции mysqli_connect()
 */

$connect = mysqli_connect("localhost", "alex228323_db", "i87&OCZk", "alex228323_db");
mysqli_set_charset($connect, "utf8");

/*
 * Делаем проверку соединения
 * Если есть ошибки, останавливаем код и выводим сообщение с ошибкой
 */

if (!$connect) {
    die('Ошибка подключения к БД!');
}
