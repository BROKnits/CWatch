<?php
namespace Database;

class Connection {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $config = require __DIR__ . '/../config/database.php';
        try {
            $this->conn = new \PDO(
                "sqlsrv:Server={$config['db']['server']};Database={$config['db']['database']}",
                $config['db']['username'],
                $config['db']['password'],
                $config['db']['options']
            );
        } catch (\PDOException $e) {
            throw new \Exception("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}