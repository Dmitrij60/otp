<?php

class Db
{
    public static function getConnection()
    {
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";

        try {
            $db = new PDO($dsn, $params['user'], $params['password']);
        } catch (PDOException $error) {
            echo "Извините, Возникли проблемы с подключением к базе данных"/*. $error->getMessage()*/
            ;
            exit;
        }
        $db->exec("set names utf8");
        return $db;
    }
}


