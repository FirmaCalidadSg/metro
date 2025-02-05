<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Plantas
{
    private $db;

    public $id;
    public $nombre_planta;
    public $ciudad_id;
    public $responsable_id;
    public $created;

    public function __construct()
    {
        error_log("Construyendo modelo Planta");
        try {
            $this->db = Database::getInstance()->getConnection();
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("SET NAMES utf8mb4");
        } catch (\Exception $e) {
            error_log("Error de conexión MySQL: " . $e->getMessage());
            throw new \Exception("No se pudo establecer la conexión con la base de datos");
        }
    }

    public function getAllPlantas()
    {
        $query = "SELECT p.*, c.nombre AS ciudad_nombre, r.nombres AS responsable_nombre 
                  FROM plantas p 
                  LEFT JOIN ciudad c ON p.ciudad_id = c.id 
                  LEFT JOIN usuarios r ON p.responsable_id = r.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPlantaById($id)
    {
        $query = "SELECT * FROM plantas WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createPlanta(Planta $planta)
    {
        $query = "INSERT INTO plantas (nombre_planta, ciudad_id, responsable_id) 
                  VALUES (:nombre_planta, :ciudad_id, :responsable_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre_planta', $planta->nombre_planta, PDO::PARAM_STR);
        $stmt->bindParam(':ciudad_id', $planta->ciudad_id, PDO::PARAM_INT);
        $stmt->bindParam(':responsable_id', $planta->responsable_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'msn' => 'Planta registrada con éxito',
                'id' => $this->db->lastInsertId(),
            ];
        } else {
            return [
                'status' => 'error',
                'msn' => 'Error en el registro de la Planta',
            ];
        }
    }

    public function updatePlanta(Planta $planta)
    {
        $query = "UPDATE plantas SET 
                    nombre_planta = :nombre_planta, 
                    ciudad_id = :ciudad_id, 
                    responsable_id = :responsable_id
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $planta->id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre_planta', $planta->nombre_planta, PDO::PARAM_STR);
        $stmt->bindParam(':ciudad_id', $planta->ciudad_id, PDO::PARAM_INT);
        $stmt->bindParam(':responsable_id', $planta->responsable_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'msn' => 'Planta actualizada con éxito',
                'id' => $planta->id,
            ];
        } else {
            return [
                'status' => 'error',
                'msn' => 'Error en la actualización de la Planta',
            ];
        }
    }

    public function deletePlanta($id)
    {
        $query = "DELETE FROM plantas WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
