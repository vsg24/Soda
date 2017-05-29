<?php

namespace Soda\Core\Database;

use Soda\Core\Utility\SQLExecutionException;

class PHPDataObjects
{
    private $db;

    public function __construct()
    {
        $dsn = SQL_DB_DRIVER_TYPE . ':host=' . SQL_DB_HOST . ';port=' . SQL_DB_PORT . ';dbname=' . SQL_DB_DEFAULT_NAME . ';charset=utf8';
        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false
        ];
        $pdo = new \PDO($dsn, SQL_DB_USERNAME, SQL_DB_PASSWORD, $opt);

        $this->db = $pdo;
    }

    /**
     * Returns an instance of PDO
     *
     * @return \PDO
     */
    public function getDB(): \PDO
    {
        return $this->db;
    }

    /**
     * @param string $query
     * @param array $params
     * @return mixed
     * @throws SQLExecutionException
     */
    public function execQueryAndFetchAll(string $query, array $params)
    {
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute($params);

        if($res)
            return $stmt->fetchAll();
        else
            throw new SQLExecutionException('Error occurred: ' . implode(":", $stmt->errorInfo()), $stmt->errorCode());
    }

    /**
     * @param string $query
     * @param array $params
     * @return mixed
     * @throws SQLExecutionException
     */
    public function execQueryAndFetchOne(string $query, array $params)
    {
        $stmt = $this->db->prepare($query);
        $res = $stmt->execute($params);

        if($res)
            return $stmt->fetchAll();
        else
            throw new SQLExecutionException('Error occurred: ' . implode(":", $stmt->errorInfo()), $stmt->errorCode());
    }
}