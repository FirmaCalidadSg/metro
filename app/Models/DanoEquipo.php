<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class DanoEquipo
{
    private $db;
    public $id;
    public $descripcion;
    public $equipo;
    public $fecha;
    public $estado;
    public function __construct()
    {
        error_log("Construyendo modelo DanoEquipo");
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


    public function getAllDanoEquipo()
    {
        $query = "SELECT d.*, e.nombre as nombre_equipo FROM danoequipo d
                INNER JOIN equipo e ON e.id = d.equipo";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getDanoEquipoById($id)
    {
        $query = "SELECT d.*, e.nombre as nombre_equipo FROM danoequipo d
                INNER JOIN equipo e ON e.id = d.equipo
                WHERE d.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createDanoEquipo(DanoEquipo $danoequipo)
    {
        $query = "INSERT INTO danoequipo (descripcion, equipo, fecha, estado) VALUES (:descripcion, :equipo, :fecha, :estado)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':descripcion', $danoequipo->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':equipo', $danoequipo->equipo, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $danoequipo->fecha, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $danoequipo->estado, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateDanoEquipo(DanoEquipo $danoequipo)
    {
        $query = "UPDATE danoequipo SET 
            descripcion = :descripcion, 
            equipo = :equipo,
            fecha = :fecha,
            estado = :estado
            WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $danoequipo->id, PDO::PARAM_INT);
        $stmt->bindParam(':descripcion', $danoequipo->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':equipo', $danoequipo->equipo, PDO::PARAM_STR);
        $stmt->bindParam(':fecha', $danoequipo->fecha, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $danoequipo->estado, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteDanoEquipo($id)
    {
        $query = "DELETE FROM danoequipo WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
