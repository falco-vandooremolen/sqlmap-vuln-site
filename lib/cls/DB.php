<?php
namespace My;

class DB
{

    private const DBTYPE = 'mysql';
    private const HOST = 'mariadb';
    private const USER = "root";
    private const PASSWORD = 'verySecureP@$w0rd';

    private \PDO $connection;

    public function __construct($database)
    {
        $this->connection = new \PDO(self::DBTYPE . ':host=' . self::HOST . ';dbname=' . $database, self::USER, self::PASSWORD, [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'']);
    }

    public function getConnector()
    {
        return $this->connection;
    }
}
