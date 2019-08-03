<?php

namespace Application\Models;

use PDOException;

class dbModelAbstract
{
    protected $connection;
    private $hostname;
    private $db;
    private $username;
    private $password;

    public function __construct()
    {
        $json = file_get_contents(dirname(__DIR__).'/Config/config.json');
        $config = json_decode($json, true)['db'];
        $this->hostname = $config['host'];
        $this->username = $config['usr'];
        $this->password = $config['pwd'];
        $this->database = $config['db'];
        try {
            $this->connection = new \PDO(
                "mysql:host=$this->hostname; 
                dbname=$this->database",
                $this->username,
                $this->password
            );
        } catch(PDOException $e) {
            die("Could not connect: $e->getMessage()");
        }
    }

    public function getData($sql) {
        $data = array();
        $result = $this->connection->prepare($sql);
        $result->execute();
        $data = $result->fetchAll(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function execute($sql) {
        try {
            $this->connection->query($sql);
        } catch (PDOException $e) {
            die('Error in execution: ' . $e->getMessage());
        }
    }
}