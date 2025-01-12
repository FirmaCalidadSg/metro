<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Equipo
{
    private $db;
    public $id;
    public $nombre;
    public $modelo;
    public $estado;
    public function __construct()
    {
        error_log("Construyendo modelo Equipo");
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


    public function getAllEquipo()
    {
        $query = "SELECT * FROM equipo";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getEquipoById($id)
    {
        $query = "SELECT * FROM equipo WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
    
        // Verificamos si se encontró el equipo
        if ($result) {
            // Creamos un nuevo objeto de tipo Equipo y asignamos los valores
            $equipo = new Equipo();
            $equipo->id = $result->id;
            $equipo->nombre = $result->nombre;
            $equipo->modelo = $result->modelo;
            $equipo->estado = $result->estado;
            return $equipo;
        }
    
        return null; // Si no se encuentra el equipo, retornamos null
    }
    

    public function createEquipo(Equipo $equipo)
    {
        $query = "INSERT INTO equipo (nombre, modelo, estado) VALUES (:nombre, :modelo, :estado)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $equipo->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':modelo', $equipo->modelo, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $equipo->estado, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateEquipo(Equipo $equipo)
    {
        $query = "UPDATE equipo SET 
            nombre = :nombre, 
            modelo = :modelo,
            estado = :estado
            WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $equipo->id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $equipo->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':modelo', $equipo->modelo, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $equipo->estado, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteEquipo($id)
    {
        $query = "DELETE FROM equipo WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
