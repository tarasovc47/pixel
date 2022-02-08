<?php

require "../core/DB.php"; // подключаем класс с БД
$link = new DB();

if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) // если в куках есть ид и хэш
{
    $query = mysqli_query($link->connect(), "SELECT * FROM users WHERE id = '" . intval($_COOKIE['id']) . "' LIMIT 1"); // запрашиваем ид в базе
    $userdata = mysqli_fetch_assoc($query);

    if ($userdata['session_hash'] !== $_COOKIE['hash'] or $userdata['id'] !== $_COOKIE['id']) // если хеш или ид из бызы не совпадают с хешем или ид из кук
    {
        setcookie("id", "", time() - 3600*24*30*12, "/"); // то обнуляем оба
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        print "Что-то пошло не так";
    }
    else // если совпадают - перенаправляем на главную
    {
        header('Location: /');
    }
}
else
{
    echo "куки выключены, надо включить";
}

?>