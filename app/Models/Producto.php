<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Producto
{
    private $db;
    public $id;
    public $nombre;
    public $codigo;
    public $descripcion;
    public $planta_id;
    public $proceso_id;
    public $linea_id;
    public function __construct()
    {
        error_log("Construyendo modelo Producto");
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


    public function getAllProducto()
    {
        $query = "SELECT * FROM producto";
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

        $data = $stmt->fetch(PDO::FETCH_OBJ);

        // Si se encuentra el producto, lo retornamos como objeto Producto
        if ($data) {
            $producto = new Producto();
            $producto->id = $data->id;
            $producto->nombre = $data->nombre;
            $producto->descripcion = $data->descripcion;
            $producto->codigo = $data->codigo;


            return $producto;
        }

        return null; // Si no se encuentra el producto, retornamos null
    }

    public function createProducto(Producto $producto)
    {
        $query = "INSERT INTO producto (planta_id, proceso_id, linea_id ,nombre, codigo, descripcion) VALUES (:planta_id, :proceso_id, :linea_id, :nombre, :codigo, :descripcion)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $producto->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':planta_id', $producto->planta_id, PDO::PARAM_STR);
        $stmt->bindParam(':proceso_id', $producto->proceso_id, PDO::PARAM_STR);
        $stmt->bindParam(':linea_id', $producto->linea_id, PDO::PARAM_STR);
        $stmt->bindParam(':codigo', $producto->codigo, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $producto->descripcion, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateProducto(Producto $producto)
    {
        $query = "UPDATE producto SET 
            nombre = :nombre, 
            codigo = :codigo,
            descripcion = :descripcion
            WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $producto->id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $producto->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':codigo', $producto->codigo, PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $producto->descripcion, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteProducto($id)
    {
        $query = "DELETE FROM producto WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
