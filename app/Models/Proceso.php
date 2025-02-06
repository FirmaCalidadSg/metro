<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Proceso
{
    private $db;

    public $id;
    public $nombre;
    public $descripcion;
    public $planta_id;
    public $responsable_id;

    public function __construct()
    {
        error_log("Construyendo modelo proceso");
        try {
            $this->db = Database::getInstance()->getConnection();
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("SET NAMES utf8mb4");
        } catch (\Exception $e) {
            error_log("Error de conexión MySQL: " . $e->getMessage());
            throw new \Exception("No se pudo establecer la conexión con la base de datos");
        }
    }

    public function getAllproceso()
    {
        $query = "SELECT e.*, p.nombre_planta AS planta_nombre, e.responsable_id as responsable_nombre
                  FROM proceso e
                  LEFT JOIN plantas p ON e.planta_id = p.id";
                 
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getprocesoById($id)
    {
        $query = "SELECT * FROM proceso WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createproceso(proceso $proceso)
    {
        $query = "INSERT INTO proceso (nombre, descripcion, planta_id, responsable_id) 
                  VALUES (:nombre, :descripcion, :planta_id, :responsable_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $proceso->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $proceso->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':planta_id', $proceso->planta_id, PDO::PARAM_INT);
        $stmt->bindParam(':responsable_id', $proceso->responsable_id, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return ['status' => 'success', 'msn' => 'proceso registrada con éxito', 'id' => $this->db->lastInsertId()];
        } else {
            return ['status' => 'error', 'msn' => 'Error en el registro de la proceso'];
        }
    }

    public function updateproceso(proceso $proceso)
    {
        $query = "UPDATE proceso SET 
                    nombre = :nombre, 
                    descripcion = :descripcion, 
                    planta_id = :planta_id, 
                    responsable_id = :responsable_id
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $proceso->id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $proceso->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $proceso->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':planta_id', $proceso->planta_id, PDO::PARAM_INT);
        $stmt->bindParam(':responsable_id', $proceso->responsable_id, PDO::PARAM_STR);

       
        
        if ($stmt->execute()) {
            return ['status' => 'success', 'msn' => 'proceso actualizado con éxito'];
        } else {
            return ['status' => 'error', 'msn' => 'Error en el registro de la proceso'];
        }
    }

    public function deleteproceso($id)
    {
        $query = "DELETE FROM proceso WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
