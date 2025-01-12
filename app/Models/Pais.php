<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Pais
{
    private $db;
    public $id;
    public $nombre;
    public $codigo;
    public function __construct()
    {
        error_log("Construyendo modelo Pais");
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


    public function getAllPais()
    {
        $query = "SELECT * FROM pais";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getPaisById($id)
    {
        $query = "SELECT * FROM pais WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
    
        // Verificamos si se encontró el registro
        if ($result) {
            // Creamos un nuevo objeto de tipo Pais y asignamos los valores
            $pais = new Pais();
            $pais->id = $result->id;
            $pais->nombre = $result->nombre;
            $pais->codigo = $result->codigo;

            return $pais;
        }
    
        return null; // Si no se encuentra el país, retornamos null
    }
    

    public function createPais(Pais $pais)
    {
        $query = "INSERT INTO pais (nombre, codigo) VALUES (:nombre, :codigo)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $pais->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':codigo', $pais->codigo, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updatePais(Pais $pais)
    {
        $query = "UPDATE pais SET 
            nombre = :nombre, 
            codigo = :codigo
            WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $pais->id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $pais->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':codigo', $pais->codigo, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deletePais($id)
    {
        $query = "DELETE FROM pais WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
