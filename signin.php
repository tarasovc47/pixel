<?php

require "core/DB.php"; // подключаем класс с БД
require "core/Cookie.php"; // подключаем класс для генерации хешей
$hash = new Cookie(); //создаём экземпляры классов
$link = new DB();

if (isset($_POST['submit']))
{
    $query = mysqli_query($link->connect(),"SELECT id, password FROM users WHERE login='" . mysqli_real_escape_string($link->connect(),$_POST['login']) . "' LIMIT 1"); // обращаемся в базу, запрашивая данные из $_POST
    $data = mysqli_fetch_assoc($query);

    if ($data['password'] === sha1(md5($_POST['password']))) // если пароли совпадают
    {
        $user_hash = $hash->generate(8); // генерируем хеш
        mysqli_query($link->connect(), "UPDATE users SET session_hash='" . $user_hash . "' WHERE id='" . $data['id'] . "'"); //заносим его в бд
        setcookie('id', $data['id'], time()+60*60*24, '/'); // и генерируем куки
        setcookie('hash', $user_hash, time()+60*60*24, '/');
        header("Location: check.php"); exit(); // перенаправляем на check.php
    }
    else
    {
        echo "Вы ввели неправильный логин/пароль";
    }
}

?>
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
    <form method="POST">
        Логин <input name="login" type="text" required><br>
        Пароль <input name="password" type="password" required><br>
        <input name="submit" type="submit" value="Войти">
    </form>
    <a href="/">На главную</a>
</body>
</html>
