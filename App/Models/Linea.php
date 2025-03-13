<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Linea
{
    private $db;

    public $id;
    public $nombre;
    public $proceso;
    public $planta_id;
    public $tipo_unidad;
    public $citg;
    public $citr;
    public $supervisor;

    public function __construct()
    {
        error_log("Construyendo modelo Linea");
        try {
            $this->db = Database::getInstance()->getConnection();
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("SET NAMES utf8mb4");
        } catch (\Exception $e) {
            error_log("Error de conexión MySQL: " . $e->getMessage());
            throw new \Exception("No se pudo establecer la conexión con la base de datos");
        }
    }

    public function getAllLineas()
    {
        $query = "SELECT l.*, p.nombre AS proceso_nombre, pl.nombre_planta AS planta_nombre 
                  FROM linea l
                  LEFT JOIN proceso p ON l.proceso = p.id
                  LEFT JOIN plantas pl ON l.planta_id = pl.id";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getLineaById($id)
    {
        $query = "SELECT * FROM linea WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createLinea(Linea $linea)
    {
        $query = "INSERT INTO linea (nombre, proceso, planta_id, tipo_unidad, citg, citr, supervisor) 
                  VALUES (:nombre, :proceso, :planta_id, :tipo_unidad, :citg, :citr, :supervisor)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $linea->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':proceso', $linea->proceso, PDO::PARAM_INT);
        $stmt->bindParam(':planta_id', $linea->planta_id, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_unidad', $linea->tipo_unidad, PDO::PARAM_INT);
        $stmt->bindParam(':citg', $linea->citg, PDO::PARAM_INT);
        $stmt->bindParam(':citr', $linea->citr, PDO::PARAM_INT);
        $stmt->bindParam(':supervisor', $linea->supervisor, PDO::PARAM_STR);



        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'msn' => 'Linea registrada con éxito',
                'id' => $this->db->lastInsertId(),
            ];
        } else {
            return [
                'status' => 'error',
                'msn' => 'Error en el registro de la linea',
            ];
        }
    }

    public function verProcesos($id)
    {
        $querySelect = "SELECT * FROM linea_proceso lp
                        JOIN proceso p ON lp.proceso_id = p.id
                        WHERE lp.linea_id = :id;";
        $stmtSelect = $this->db->prepare($querySelect);
        $stmtSelect->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtSelect->execute();
        return $stmtSelect->fetchAll(PDO::FETCH_OBJ);
    }

    public function agregarProcesos($proceso_id, $linea_id)
    {
        $query = "INSERT INTO linea_proceso (proceso_id, linea_id) VALUES (:proceso_id, :linea_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':proceso_id', $proceso_id, PDO::PARAM_INT);
        $stmt->bindParam(':linea_id', $linea_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'msn' => 'Proceso agregado a la línea con éxito',
                'id' => $this->db->lastInsertId(),
            ];
        } else {
            return [
                'status' => 'error',
                'msn' => 'Error al agregar el proceso a la línea',
            ];
        }
    }

    public function updateLinea(Linea $linea)
    {
        $query = "UPDATE linea SET 
                    nombre = :nombre, 
                    proceso = :proceso, 
                    planta_id = :planta_id, 
                    tipo_unidad = :tipo_unidad, 
                    citg = :citg, 
                    citr = :citr, 
                    supervisor = :supervisor
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $linea->id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $linea->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':proceso', $linea->proceso, PDO::PARAM_INT);
        $stmt->bindParam(':planta_id', $linea->planta_id, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_unidad', $linea->tipo_unidad, PDO::PARAM_INT);
        $stmt->bindParam(':citg', $linea->citg, PDO::PARAM_INT);
        $stmt->bindParam(':citr', $linea->citr, PDO::PARAM_INT);
        $stmt->bindParam(':supervisor', $linea->supervisor, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'msn' => 'Linea actualizada con éxito',
                'id' => $this->db->lastInsertId(),
            ];
        } else {
            return [
                'status' => 'error',
                'msn' => 'Error en la actualizacion de la linea',
            ];
        }
    }

    public function deleteLinea($id)
    {
        $query = "DELETE FROM linea WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function GetByPlanta($id)
    {
        $query = "SELECT l.id, l.nombre, l.proceso FROM linea l WHERE planta_id=:planta";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':planta', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getLineaByProceso($id)
    {
        $query = "SELECT l.id, l.nombre, l.proceso 
                    FROM linea l 
                    WHERE proceso=:proceso_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':proceso_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function GetlineaEquipo($linea_id)
    {
        $tipo = "empaque";
        try {
            $sql = "SELECT e.nombre, e.modelo,e.id as eq_id  
             FROM 
             linea_equipo le join equipo e ON le.equipo_id=e.id
             WHERE
             le.linea_id=:linea_id 
             AND tipo=:tipo";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':linea_id', $linea_id, PDO::PARAM_INT);
            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
