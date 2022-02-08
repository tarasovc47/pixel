<?php

class Cookie
{
    function generate($length = 6) { // функция generate, по умоланию аргумент - 6
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789"; // из чего будем выбирать
        $rand = null; // наш пока "пустой"
        $clen = strlen($chars) - 1;
        while (strlen($rand) < $length) {
            $rand .= $chars[mt_rand(0,$clen)];
        }
        return $rand;
    }
}