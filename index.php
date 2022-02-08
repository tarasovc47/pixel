<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php

require "core/DB.php"; //подключаем класс с БД

if (empty($_COOKIE)) // если куки пустые то отправляем на логин или регистрацию
{
    ?>
    <a href="signin.php">Войти</a><br>
    <a href="signup.php">Зарегистрироваться</a>
    <?php
    }
else // если куки не пустые
{
    $link = new DB(); //идём в базу
    $query = mysqli_query($link->link(), "SELECT id, login, name, surname FROM users WHERE id = '" . $_COOKIE['id'] . "' AND session_hash='" . $_COOKIE['hash'] . "' LIMIT 1" ); // и запрашиваем совпадающие строки
    $data = mysqli_fetch_assoc($query);
    ?>
    Привет, <?= $data['name'] ?>
    <table>
        <thead>
        <tr>
            <td>id</td>
            <td>Логин</td>
            <td>Имя</td>
            <td>Фамилия</td>
        </tr>
        <tr>
            <td><?= $data['id'] ?></td>
            <td><?= $data['login'] ?></td>
            <td><?= $data['name'] ?></td>
            <td><?= $data['surname'] ?></td>
        </tr>
        </thead>
    </table>
    <a href="logout.php">Выйти</a>
    <a href="/">На главную</a>
    <?php
}

?>

</body>
</html>
