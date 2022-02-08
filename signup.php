<?php

require "core/DB.php"; // подключаем класс с БД

if (isset($_POST['submit']))
{
    $errors = [];

    if (!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $errors[] = "только английские символы и цифры";
    }
    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $errors[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }

    $link = new DB();// создаём экземпляр класса БД
    $query = mysqli_query($link->connect(), "SELECT id FROM users WHERE login='".mysqli_real_escape_string($link->connect(), $_POST['login'])."'"); // запрос в базе такого логина
    if(mysqli_num_rows($query) > 0) // если вернулась хоть одна строка
    {
        $errors[] = "Пользователь с таким логином уже существует в базе данных";
    }

    if (count($errors) == 0) // если ошибок не возникло
    {
        $login = $_POST['login']; //записываем всё в переменные
        $password = sha1(md5(trim($_POST['password']))); //пароль хешируем
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        mysqli_query($link->connect(),"INSERT INTO users SET login='" . $login . "', password='" . $password . "', name='" . $name . "', surname='" . $surname . "'"); // и передаём всё в БД
        header("Location: signin.php"); // перенаправляем на страницу входа
        exit();
    }
    else
    {
        echo 'Возникли следующие ошибки';
        foreach ($errors as $error)
        {
            var_dump($error);
        }
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
        Имя <input name="name" type="text" required><br>
        Фамилия <input name="surname" type="text" required><br>
        <input name="submit" type="submit" value="Регистрация">
    </form>
    <a href="/">На главную</a>
</body>
</html>
