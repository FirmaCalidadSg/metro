<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class CategoriaParos
{
    private $db;

    public $id_distribucion;
    public $id_categoria;
    public $nombre;
    public $descripcion;

    public function __construct()
    {
        error_log("Construyendo modelo CategoriaParos");
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

    public function getAllCategoriaParos()
    {
        $query = "SELECT cp.*,dt.id as id_distribucion, dt.nombre as distribucion FROM categoriaparos cp JOIN distribuciontiempos dt ON cp.id_distribucion = dt.id;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCategoriaParosById($id_categoria)
    {
        $query = "SELECT * FROM categoriaparos WHERE id_categoria = :id_categoria";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createCategoriaParos(CategoriaParos $categoriaParos)
    {
        $query = "INSERT INTO categoriaparos (nombre, descripcion, id_distribucion) VALUES (:nombre, :descripcion, :id_distribucion)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $categoriaParos->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $categoriaParos->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':id_distribucion', $categoriaParos->id_distribucion, PDO::PARAM_INT);
        
        $id_categoria = "";
        if ($stmt->execute()) {
            $id_categoria = $this->db->lastInsertId();
            $result = [
                'status' => 'success',
                'msn' => 'Categoría registrada con éxito',
                'id_categoria' => $id_categoria,
            ];
        } else {
            $result = [
                'status' => 'error',
                'msn' => 'Error en el registro de la categoría',
                'id_categoria' => $id_categoria,
            ];
        }
        return $result;
    }

    public function updateCategoriaParos(CategoriaParos $categoriaParos)
    {
        $query = "UPDATE categoriaparos SET 
            nombre = :nombre, 
            descripcion = :descripcion,
            id_distribucion = :id_distribucion
            WHERE id_categoria = :id_categoria";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_categoria', $categoriaParos->id_categoria, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $categoriaParos->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $categoriaParos->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':id_distribucion', $categoriaParos->id_distribucion, PDO::PARAM_INT);
        
        $result = [];
        if ($stmt->execute()) {
            $result = [
                'status' => 'success',
                'msn' => 'Categoría actualizada con éxito',
                'id_categoria' => $categoriaParos->id_categoria,
            ];
        } else {
            $result = [
                'status' => 'error',
                'msn' => 'Error en la actualización de la categoría',
                'id_categoria' => $categoriaParos->id_categoria,
            ];
        }
        return $result;
    }

    public function deleteCategoriaParos($id_categoria)
    {
        $query = "DELETE FROM categoriaparos WHERE id_categoria = :id_categoria";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
