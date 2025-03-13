<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class TiposParos
{
    private $db;

    public $id_tipo;
    public $id_subcategoria;
    public $nombre;
    public $descripcion;

    public function __construct()
    {
        error_log("Construyendo modelo TiposParos");
        try {
            $this->db = Database::getInstance()->getConnection();
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("SET NAMES utf8mb4");
        } catch (\Exception $e) {
            error_log("Error de conexión MySQL: " . $e->getMessage());
            throw new \Exception("No se pudo establecer la conexión con la base de datos");
        }
    }

    public function getAllTiposParos()
    {
        $query = "SELECT tp.*, sp.nombre AS nombre_subcategoria 
                  FROM tiposparos tp 
                  JOIN subcategoriaparos sp ON tp.id_subcategoria = sp.id_subcategoria";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTiposParosById($id_tipo)
    {
        $query = "SELECT * FROM tiposparos WHERE id_tipo = :id_tipo";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_tipo', $id_tipo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createTiposParos(TiposParos $tipoParo)
    {
        $query = "INSERT INTO tiposparos (id_subcategoria, nombre, descripcion) 
                  VALUES (:id_subcategoria, :nombre, :descripcion)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_subcategoria', $tipoParo->id_subcategoria, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $tipoParo->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $tipoParo->descripcion, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'msn' => 'Tipo de Paro registrado con éxito',
                'id_tipo' => $this->db->lastInsertId(),
            ];
        } else {
            return [
                'status' => 'error',
                'msn' => 'Error en el registro del Tipo de Paro',
            ];
        }
    }

    public function updateTiposParos(TiposParos $tipoParo)
    {
        $query = "UPDATE tiposparos SET 
                    id_subcategoria = :id_subcategoria, 
                    nombre = :nombre, 
                    descripcion = :descripcion 
                  WHERE id_tipo = :id_tipo";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_tipo', $tipoParo->id_tipo, PDO::PARAM_INT);
        $stmt->bindParam(':id_subcategoria', $tipoParo->id_subcategoria, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $tipoParo->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $tipoParo->descripcion, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'msn' => 'Tipo de Paro actualizado con éxito',
                'id_tipo' => $tipoParo->id_tipo,
            ];
        } else {
            return [
                'status' => 'error',
                'msn' => 'Error en la actualización del Tipo de Paro',
            ];
        }
    }

    public function deleteTiposParos($id_tipo)
    {
        $query = "DELETE FROM tiposparos WHERE id_tipo = :id_tipo";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_tipo', $id_tipo, PDO::PARAM_INT);
        return $stmt->execute();
    }


    /** TBL PAROS */


    public function getParosByTiempo($dtiempo_id)
    {

        try {
            $sql = "SELECT id, nombre FROM paros WHERE dtiempo_id=:dtiempo";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':dtiempo', $dtiempo_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (\PDOException $th) {
            throw $th;
        }
    }
    public function getSubParosByParos($paro_id)
    {

        try {
            $sql = "SELECT id, nombre FROM subparos WHERE paro_id=:paro_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':paro_id', $paro_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (\PDOException $th) {
            throw $th;
        }
    }
    public function getRazonBySubParo($subparo_id)
    {

        try {
            $sql = "SELECT id, descripcion FROM razones_paro WHERE subparo_id=:subparo_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':subparo_id', $subparo_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (\PDOException $th) {
            throw $th;
        }
    }


}
