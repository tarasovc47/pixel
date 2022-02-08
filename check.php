<?php

require "core/DB.php";
$link = new DB();

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    $query = mysqli_query($link->connect(), "SELECT * FROM users WHERE id = '" . intval($_COOKIE['id']) . "' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);

    if ($userdata['session_hash'] !== $_COOKIE['hash'] or $userdata['id'] !== $_COOKIE['id'])
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        print "Что-то пошло не так";
    }
    else
    {
        header('Location: index.php');
    }
}
else
{
    echo "куки выключены, надо включить";
}

?>