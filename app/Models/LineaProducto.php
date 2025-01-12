<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class LineaProducto
{
    private $db;
    public $id;
    public $linea;
    public $producto;
    public $capacidad_produccion;
    public $nombre_linea;
    public $nombre_producto;
    public function __construct()
    {
        error_log("Construyendo modelo LineaProducto");
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


    public function getAllLineaProducto()
    {
        $query = "SELECT lp.*, l.nombre as nombre_linea, p.nombre as nombre_producto FROM lineaproducto lp
                INNER JOIN linea l ON l.id = lp.linea
                INNER JOIN producto p ON p.id = lp.producto";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getLineaProductoById($id)
    {
        $query = "SELECT lp.*, l.nombre as nombre_linea, p.nombre as nombre_producto FROM lineaproducto lp
                  INNER JOIN linea l ON l.id = lp.linea
                  INNER JOIN producto p ON p.id = lp.producto
                  WHERE lp.id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        
        if ($data) {
            $lineaProducto = new LineaProducto();
            $lineaProducto->id = $data->id;
            $lineaProducto->linea = $data->linea;
            $lineaProducto->producto = $data->producto;
            $lineaProducto->nombre_linea = $data->nombre_linea;
            $lineaProducto->nombre_producto = $data->nombre_producto;
            $lineaProducto->capacidad_produccion = $data->capacidad_produccion;

            return $lineaProducto;
        }
        
        return null;
    }
    

    public function createLineaProducto(LineaProducto $lineaproducto)
    {
        $query = "INSERT INTO lineaproducto (linea, producto, capacidad_produccion) VALUES (:linea, :producto, :capacidad_produccion)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':linea', $lineaproducto->linea, PDO::PARAM_STR);
        $stmt->bindParam(':producto', $lineaproducto->producto, PDO::PARAM_STR);
        $stmt->bindParam(':capacidad_produccion', $lineaproducto->capacidad_produccion, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateLineaProducto(LineaProducto $lineaproducto)
    {
        $query = "UPDATE lineaproducto SET 
            linea = :linea, 
            producto = :producto,
            capacidad_produccion = :capacidad_produccion
            WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $lineaproducto->id, PDO::PARAM_INT);
        $stmt->bindParam(':linea', $lineaproducto->linea, PDO::PARAM_STR);
        $stmt->bindParam(':producto', $lineaproducto->producto, PDO::PARAM_STR);
        $stmt->bindParam(':capacidad_produccion', $lineaproducto->capacidad_produccion, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteLineaProducto($id)
    {
        $query = "DELETE FROM lineaproducto WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
