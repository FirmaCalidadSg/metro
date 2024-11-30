<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Departamento
{
    private $db;
    public $id;
    public $nombre;
    public $pais;
    public function __construct()
    {
        error_log("Construyendo modelo Departamento");
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


    public function getAllDepartamento()
    {
        $query = "SELECT d.*, p.nombre as nombre_pais FROM departamento d
                INNER JOIN pais p ON p.id = d.pais";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getDepartamentoById($id)
    {
        $query = "SELECT d.*, p.nombre as nombre_pais FROM departamento d
                INNER JOIN pais p ON p.id = d.pais
                WHERE d.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createDepartamento(Departamento $departamento)
    {
        $query = "INSERT INTO departamento (nombre, pais) VALUES (:nombre, :pais)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $departamento->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':pais', $departamento->pais, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateDepartamento(Departamento $departamento)
    {
        $query = "UPDATE departamento SET 
            nombre = :nombre, 
            pais = :pais
            WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $departamento->id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $departamento->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':pais', $departamento->pais, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteDepartamento($id)
    {
        $query = "DELETE FROM departamento WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
