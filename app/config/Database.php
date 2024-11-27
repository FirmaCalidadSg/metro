<?php
namespace App\Config;
require_once __DIR__ . '/config.php';

class Database {
    private static $instance = null;
    private $conn;
    // private static $dbType = 'sqlserver'; // Puede ser 'mysql' o 'sqlserver'
    private static $dbType = 'mysql'; // Puede ser 'mysql' o 'sqlserver'

    private function connectMySql() {
        try {
            $dsn = "mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            
            error_log("Intentando conexión MySQL con DSN: " . $dsn);
            error_log("Usuario: " . DB_USER);
            
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_TIMEOUT => 5
            ];

            $this->conn = new \PDO($dsn, DB_USER, DB_PASS, $options);
            error_log("Conexión exitosa a MySQL");

        } catch (\PDOException $e) {
            error_log("Error PDO MySQL: " . $e->getMessage());
            throw new \Exception("Error de conexión a MySQL: " . $e->getMessage());
        }
    }

    private function connectSqlServer() {
        try {
            $dsn = "sqlsrv:Server=" . DB_SERVER . ";Database=" . DB_NAME . ";TrustServerCertificate=1";
            
            error_log("Intentando conexión SQL Server con DSN: " . $dsn);
            error_log("Usuario: " . DB_USER);
            
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_TIMEOUT => 5
            ];

            $this->conn = new \PDO($dsn, DB_USER, DB_PASS, $options);
            error_log("Conexión exitosa a SQL Server");

        } catch (\PDOException $e) {
            error_log("Error PDO SQL Server: " . $e->getMessage());
            throw new \Exception("Error de conexión a SQL Server: " . $e->getMessage());
        }
    }

    public static function setDbType($type) {
        if (!in_array($type, ['mysql', 'sqlserver'])) {
            throw new \Exception("Tipo de base de datos no válido. Use 'mysql' o 'sqlserver'");
        }
        self::$dbType = $type;
    }

    public static function getDbType() {
        return self::$dbType;
    }

    private function __construct() {
        if (self::$dbType === 'mysql') {
            $this->connectMySql();
        } else {
            $this->connectSqlServer();
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

    // Método para probar la conexión
    public static function testConnection() {
        try {
            $db = self::getInstance()->getConnection();
            
            // Intentar una consulta simple
            $stmt = $db->query("SELECT @@version as version");
            $result = $stmt->fetch();
            
            return [
                'success' => true,
                'message' => 'Conexión exitosa',
                'version' => $result['version'],
                'server' => DB_SERVER,
                'database' => DB_NAME
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'server' => DB_SERVER,
                'database' => DB_NAME
            ];
        }
    }
} 