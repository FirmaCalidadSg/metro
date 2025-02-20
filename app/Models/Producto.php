<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Producto
{
    private $db;
    public $id;
    public $linea_id;
    public $nombre;
    public $codigo;
    public $descripcion;
    public function __construct()
    {
        error_log("Construyendo modelo Producto");
        try {
            $this->db = Database::getInstance()->getConnection();
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("SET NAMES utf8mb4");
        } catch (\Exception $e) {
            error_log("Error de conexión MySQL: " . $e->getMessage());
            throw new \Exception("No se pudo establecer la conexión con la base de datos");
        }
    }

    public function getAllProducto()
    {
        $query = "SELECT p.*, l.nombre AS linea_nombre
                  FROM producto p
                  LEFT JOIN linea l ON p.linea_id = l.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getProductoById($id)
    {
        $query = "SELECT * FROM producto WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createProducto(Producto $producto)
    {
        $query = "INSERT INTO producto (linea_id, nombre, codigo, descripcion) 
                  VALUES (:linea_id, :nombre, :codigo, :descripcion)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':linea_id', $producto->linea_id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $producto->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':codigo', $producto->codigo, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $producto->descripcion, PDO::PARAM_STR);


        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'msn' => 'Producto registrado con éxito',
                'id' => $this->db->lastInsertId(),
            ];
        } else {
            return [
                'status' => 'error',
                'msn' => 'Error al agregar el producto',
            ];
        }
    }

    public function updateProducto(Producto $producto)
    {
        $query = "UPDATE producto SET 
                    linea_id = :linea_id,
                    nombre = :nombre,
                    codigo = :codigo,
                    descripcion = :descripcion
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $producto->id, PDO::PARAM_INT);
        $stmt->bindParam(':linea_id', $producto->linea_id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $producto->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':codigo', $producto->codigo, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $producto->descripcion, PDO::PARAM_STR);


        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'msn' => 'Producto actualizado con éxito',
                'id' => $this->db->lastInsertId(),
            ];
        } else {
            return [
                'status' => 'error',
                'msn' => 'Error al agregar el producto',
            ];
        }
    }

    public function deleteProducto($id)
    {
        $query = "DELETE FROM producto WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function productosBYPlantaLineaProceso($planta_id, $proceso_id)
    {
        try {
            $sql = "SELECT * FROM producto 
            WHERE proceso_id=:proceso_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':planta_id', $planta_id, PDO::PARAM_INT);
            $stmt->bindParam(':proceso_id', $proceso_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $th) {
            throw $th;
        }
    }
    public function productosBYLineaProceso( $proceso_id)
    {
        try {
            $sql = "SELECT p.* 
                    FROM producto p           
            JOIN lineaproducto lp on p.id=producto_id           
            WHERE lp.proceso_id=:proceso_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':proceso_id', $proceso_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (\PDOException $th) {
            throw $th;
        }
    }
}
