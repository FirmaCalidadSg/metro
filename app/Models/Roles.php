<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Roles
{
    private $db;
    public $id;
    public $rol;

    public function __construct()
    {
        error_log("Construyendo modelo Roles");
        try {
            $this->db = Database::getInstance()->getConnection();
            $this->db->query('SELECT 1');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("SET NAMES utf8mb4");
        } catch (\Exception $e) {
            error_log("Error de conexión MySQL: " . $e->getMessage());
            throw new \Exception("No se pudo establecer la conexión con la base de datos");
        }
    }

    public function getAllRoles()
    {
        $sql = "SELECT * FROM roles";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getRolById($id)
    {
        $sql = "SELECT * FROM roles WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createRol(Roles $roles)
    {
        $query = "INSERT INTO roles (rol) VALUES (:rol)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':rol', $roles->rol, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateRol(Roles $roles)
    {
        $query = "UPDATE roles SET 
            rol = :rol
            WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $roles->id, PDO::PARAM_INT);
        $stmt->bindParam(':rol', $roles->rol, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteRol($id)
    {
        $query = "DELETE FROM roles WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
