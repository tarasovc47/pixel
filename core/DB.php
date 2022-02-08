<?php
class DB
{
    /**
     * CREATE TABLE `users` (
        `id` int(11) unsigned NOT NULL auto_increment,
        `login` text(32) NOT NULL,
        `password` text(32) NOT NULL,
        `name` text(32) NOT NULL,
        `surname` text(32) NOT NULL,
        `session_hash` text(4096),
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
     */

    public function link() // функция коннекта к БД
    {
        return mysqli_connect("127.0.0.1", "root", "root", "pixel");
    }
}