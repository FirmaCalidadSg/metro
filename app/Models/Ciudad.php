<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Ciudad
{
    private $db;
    public $id;
    public $nombre;
    public $departamento;
    public $codigo_postal;
    public $nombre_departamento;
    public function __construct()
    {
        error_log("Construyendo modelo Ciudad");
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


    public function getAllCiudad()
    {
        $query = "SELECT c.*, d.nombre as nombre_departamento FROM ciudad c
                INNER JOIN departamento d ON d.id = c.departamento";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getCiudadById($id)
    {
        $query = "SELECT c.*, d.nombre as nombre_departamento 
                  FROM ciudad c
                  INNER JOIN departamento d ON d.id = c.departamento
                  WHERE c.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
    
        // Verificamos si se encontró la ciudad
        if ($result) {
            // Creamos un nuevo objeto de tipo Ciudad y asignamos los valores
            $ciudad = new Ciudad();
            $ciudad->id = $result->id;
            $ciudad->nombre = $result->nombre;
            $ciudad->departamento = $result->departamento;
            $ciudad->nombre_departamento = $result->nombre_departamento; // Asignamos el valor del departamento{}
            $ciudad->codigo_postal = $result->codigo_postal;
    
            return $ciudad;
        }
    
        return null; // Si no se encuentra la ciudad, retornamos null
    }
    

    public function createCiudad(Ciudad $ciudad)
    {
        $query = "INSERT INTO ciudad (nombre, departamento, codigo_postal) VALUES (:nombre, :departamento, :codigo_postal)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $ciudad->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':departamento', $ciudad->departamento, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_postal', $ciudad->codigo_postal, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateCiudad(Ciudad $ciudad)
    {
        $query = "UPDATE ciudad SET 
            nombre = :nombre, 
            departamento = :departamento,
            codigo_postal = :codigo_postal
            WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $ciudad->id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $ciudad->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':departamento', $ciudad->departamento, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_postal', $ciudad->codigo_postal, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteCiudad($id)
    {
        $query = "DELETE FROM ciudad WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
