<?php

class Db
{
    private static $instance = null;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance                 = new PDO('pgsql:host=localhost;port=5432;dbname=TodoListsDB', 'postgres', 'op5852');
        }

        return self::$instance;
    }
}
