<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Plantas
{

    private $db;
    public $id;
    public $nombre;
    public $ciudad_id;
    public $responsable_id;
    public $created;


    public function __construct()
    {
        error_log("Construyendo modelo Plantas");
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

    public function getAllPlantas()
    {
        $query = "SELECT p.*, c.nombre as ciudad_nombre
                  FROM plantas p
                  INNER JOIN ciudad c ON c.id = p.ciudad_id
                  ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPlantaById($id)
    {
        $query = "SELECT p.*, c.nombre as ciudad_nombre, d.nombre as departamento_nombre, pa.nombre as pais_nombre
                  FROM plantas p
                  INNER JOIN ciudad c ON c.id = p.ciudad
                  INNER JOIN departamento d ON d.id = p.departamento
                  INNER JOIN pais pa ON pa.id = p.pais
                  WHERE p.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        // Verificamos si se encontró la planta
        if ($result) {
            // Creamos un nuevo objeto de tipo Plantas y asignamos los valores
            $planta = new Plantas();
            $planta->id = $result->id;
            $planta->nombre = $result->nombre;
            $planta->ciudad_id = $result->ciudad;
            $planta->ciudad_nombre = $result->ciudad_nombre;
        }
    }

    public function createPlanta($planta)
    {
        $query = "INSERT INTO plantas (nombre_planta, ciudad_id, responsable_id)
                  VALUES (:nombre, :ciudad, :responsable_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $planta->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':ciudad', $planta->ciudad_id, PDO::PARAM_INT);
        $stmt->bindParam(':responsable_id', $planta->responsable_id, PDO::PARAM_INT);
        $id = "";
        if ($stmt->execute()) {
            $id = $this->db->lastInsertId();
            $result = [
                'status' => 'success',
                'msn' => 'Planta registada con éxito',
                'id' => $id,
            ];
        } else {
            $result = [
                'status' => 'error',
                'msn' => 'Planta no registada con éxito, trate de nuevo mas tarde',
                'id' => $id,
            ];
        }
        return $result;
    }

    public function updatePlanta($planta)
    {
        $query = "UPDATE plantas SET nombre = :nombre, ciudad = :ciudad, responsable_id = :responsable_id
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $planta->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':ciudad', $planta->ciudad_id, PDO::PARAM_INT);
        $stmt->bindParam(':responsable_id', $planta->responsable_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $planta->id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
