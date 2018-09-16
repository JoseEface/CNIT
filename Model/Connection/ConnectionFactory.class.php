<?php

namespace Model\Connection;

class ConnectionFactory {

    public static function getConnection() {
	//Conta genérica, deve ser substituída na conta oficial
        return new \PDO("mysql:dbname=cnit;host=localhost","admin","hlnomysql1");
    }

}

?>
