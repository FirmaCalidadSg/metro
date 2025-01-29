<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Linea
{
    private $db;
    public $id;
    public $nombre;
    public $proceso;
    public $nombre_proceso;
    public function __construct()
    {
        error_log("Construyendo modelo Linea");
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


    public function getAllLinea()
    {
        $query = "SELECT l.*, p.nombre as nombre_proceso FROM linea l
                INNER JOIN proceso p ON p.id = l.proceso";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function GetByPlanta($id)
    {
        $query = "SELECT l.id, l.nombre, l.proceso FROM linea l WHERE planta_id=:planta";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planta', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getLineaById($id)
    {
        $query = "SELECT l.*, p.nombre as nombre_proceso FROM linea l
                INNER JOIN proceso p ON p.id = l.proceso
                WHERE l.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_OBJ);

        if ($data) {
            $linea = new Linea();
            $linea->id = $data->id;
            $linea->nombre = $data->nombre;
            $linea->proceso = $data->proceso;
            $linea->nombre_proceso = $data->nombre_proceso;
            return $linea;
        }

        return null;
    }

    public function createLinea(Linea $linea)
    {
        $query = "INSERT INTO linea (nombre, proceso) VALUES (:nombre, :proceso)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $linea->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':proceso', $linea->proceso, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateLinea(Linea $linea)
    {
        $query = "UPDATE linea SET 
            nombre = :nombre, 
            proceso = :proceso
            WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $linea->id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $linea->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':proceso', $linea->proceso, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteLinea($id)
    {
        $query = "DELETE FROM linea WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
