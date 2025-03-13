<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class DistribucionTiempos
{
    private $db;

    public $id;
    public $nombre;

    public function __construct()
    {
        error_log("Construyendo modelo DistribucionTiempos");
        try {
            $this->db = Database::getInstance()->getConnection();
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("SET NAMES utf8mb4");
        } catch (\Exception $e) {
            error_log("Error de conexión MySQL: " . $e->getMessage());
            throw new \Exception("No se pudo establecer la conexión con la base de datos");
        }
    }

    public function getAllDistribucionTiempos()
    {
        $query = "SELECT * FROM distribuciontiempos";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getDistribucionTiemposById($id)
    {
        $query = "SELECT * FROM distribuciontiempos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createDistribucionTiempos(DistribucionTiempos $distribucionTiempos)
    {
        $query = "INSERT INTO distribuciontiempos (nombre) VALUES (:nombre)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $distribucionTiempos->nombre, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'msn' => 'Distribución de Tiempo registrada con éxito',
                'id' => $this->db->lastInsertId(),
            ];
        } else {
            return [
                'status' => 'error',
                'msn' => 'Error en el registro de la Distribución de Tiempo',
            ];
        }
    }

    public function updateDistribucionTiempos(DistribucionTiempos $distribucionTiempos)
    {
        $query = "UPDATE distribuciontiempos SET nombre = :nombre WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $distribucionTiempos->id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $distribucionTiempos->nombre, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'msn' => 'Distribución de Tiempo actualizada con éxito',
                'id' => $distribucionTiempos->id,
            ];
        } else {
            return [
                'status' => 'error',
                'msn' => 'Error en la actualización de la Distribución de Tiempo',
            ];
        }
    }

    public function deleteDistribucionTiempos($id)
    {
        $query = "DELETE FROM distribuciontiempos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
