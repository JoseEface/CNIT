<?php

namespace Model\Connection;

class ConnectionFactory {

    public static function getConnection() {
        return new \PDO("mysql:dbname=cnit;host=localhost","admin","hlnomysql1");
    }

}

?>