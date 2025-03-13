<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class SubCategoriaParos
{
    private $db;

   
    public $id_subcategoria;
    public $id_categoria;
    public $nombre;
    public $descripcion;

    public function __construct()
    {
        error_log("Construyendo modelo SubCategoriaParos");
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

    public function getAllSubCategoriaParos()
    {
        $query = "SELECT sc.*, c.nombre as nombre_categoria FROM subcategoriaparos sc JOIN categoriaparos c ON sc.id_categoria = c.id_categoria ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getSubCategoriaParosById($id_subcategoria)
    {
        $query = "SELECT * FROM subcategoriaparos WHERE id_subcategoria = :id_subcategoria";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_subcategoria', $id_subcategoria, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createSubCategoriaParos(SubCategoriaParos $subCategoriaParos)
    {
        $query = "INSERT INTO subcategoriaparos (id_categoria, nombre, descripcion) VALUES (:id_categoria, :nombre, :descripcion)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_categoria', $subCategoriaParos->id_categoria, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $subCategoriaParos->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $subCategoriaParos->descripcion, PDO::PARAM_STR);
        
        $id_subcategoria = "";
        if ($stmt->execute()) {
            $id_subcategoria = $this->db->lastInsertId();
            $result = [
                'status' => 'success',
                'msn' => 'Subcategoría registrada con éxito',
                'id_subcategoria' => $id_subcategoria,
            ];
        } else {
            $result = [
                'status' => 'error',
                'msn' => 'Error en el registro de la subcategoría',
                'id_subcategoria' => $id_subcategoria,
            ];
        }
        return $result;
    }

    public function updateSubCategoriaParos(SubCategoriaParos $subCategoriaParos)
    {
        $query = "UPDATE subcategoriaparos SET 
            id_categoria = :id_categoria,
            nombre = :nombre, 
            descripcion = :descripcion
            WHERE id_subcategoria = :id_subcategoria";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_subcategoria', $subCategoriaParos->id_subcategoria, PDO::PARAM_INT);
        $stmt->bindParam(':id_categoria', $subCategoriaParos->id_categoria, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $subCategoriaParos->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $subCategoriaParos->descripcion, PDO::PARAM_STR);
        
        $result = [];
        if ($stmt->execute()) {
            $result = [
                'status' => 'success',
                'msn' => 'Subcategoría actualizada con éxito',
                'id_subcategoria' => $subCategoriaParos->id_subcategoria,
            ];
        } else {
            $result = [
                'status' => 'error',
                'msn' => 'Error en la actualización de la subcategoría',
                'id_subcategoria' => $subCategoriaParos->id_subcategoria,
            ];
        }
        return $result;
    }

    public function deleteSubCategoriaParos($id_subcategoria)
    {
        $query = "DELETE FROM subcategoriaparos WHERE id_subcategoria = :id_subcategoria";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_subcategoria', $id_subcategoria, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
