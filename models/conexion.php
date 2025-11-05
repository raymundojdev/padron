<?php

class conexiondb
{
    static public function conectar()
    {
        $link = new PDO("mysql:host=localhost;dbname=zona52", "root", "");

        $link->exec("set names utf8");

        return $link;
    }
}
