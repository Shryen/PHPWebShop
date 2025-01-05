<?php
class Database
{
    private $dsn = 'mysql:host=php-docker-db;dbname=myapp;charset=utf8mb4';
    private $user = 'user';
    private $password = 'password';

    public $connection;

    public function connect()
    {
        try {
            $this->connection = new PDO($this->dsn, $this->user, $this->password);
            //for errors
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function execute($query, $params = [])
    {
        $stmt = $this->connection->prepare($query);
        return $stmt->execute($params);
    }

    public function fetch($query, $params = [])
    {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

