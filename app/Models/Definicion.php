<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Definicion
{
    private $db;
    public $id;
    public $nombre;
    public $valor;
    public $descripcion;
    public function __construct()
    {
        error_log("Construyendo modelo Definicion");
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


    public function getAllDefinicion()
    {
        $query = "SELECT * FROM definicion";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getDefinicionById($id)
    {
        $query = "SELECT * FROM definicion WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
    
        // Verificamos si se encontró el registro
        if ($result) {
            // Convertimos el stdClass a un objeto de la clase Definicion
            $definicion = new Definicion();
            $definicion->id = $result->id;
            $definicion->nombre = $result->nombre;
            $definicion->valor = $result->valor;
            $definicion->descripcion = $result->descripcion;
    
            return $definicion;
        }
    
        return null; // Si no se encuentra la definición, retornamos null
    }
    

    public function createDefinicion(Definicion $definicion)
    {
        $query = "INSERT INTO definicion (nombre, valor, descripcion) VALUES (:nombre, :valor, :descripcion)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $definicion->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':valor', $definicion->valor, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $definicion->descripcion, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateDefinicion(Definicion $definicion)
    {
        $query = "UPDATE definicion SET 
            nombre = :nombre, 
            valor = :valor, 
            descripcion = :descripcion
            WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $definicion->id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $definicion->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':valor', $definicion->valor, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $definicion->descripcion, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteDefinicion($id)
    {
        $query = "DELETE FROM definicion WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
