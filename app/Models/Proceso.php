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
        error_log("Construyendo modelo Proceso");
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


    public function getAllProceso()
    {
        $query = "SELECT * FROM proceso";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getProcesoById($id)
    {
        $query = "SELECT * FROM proceso WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_OBJ);

        // Si se encuentra el proceso, lo retornamos como objeto Proceso
        if ($data) {
            $proceso = new Proceso();
            $proceso->id = $data->id;
            $proceso->nombre = $data->nombre;
            $proceso->descripcion = $data->descripcion;
            // Asigna otras propiedades según la estructura de la tabla proceso

            return $proceso;
        }

        return null; // Si no se encuentra el proceso, retornamos null
    }

    public function getProcesoByPlanta($id)
    {
        $query = "SELECT p.id as proceso_id,p.nombre FROM proceso p WHERE p.planta_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }


    public function createProceso(Proceso $proceso)
    {
        $query = "INSERT INTO proceso (nombre, descripcion, planta_id, responsable_id) VALUES (:nombre, :descripcion, :planta_id, :responsable_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $proceso->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $proceso->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':planta_id', $proceso->planta_id, PDO::PARAM_INT);
        $stmt->bindParam(':responsable_id', $proceso->responsable_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function updateProceso(Proceso $proceso)
    {
        $query = "UPDATE proceso SET 
            nombre = :nombre, 
            descripcion = :descripcion
            WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $proceso->id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $proceso->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $proceso->descripcion, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteProceso($id)
    {
        $query = "DELETE FROM proceso WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
