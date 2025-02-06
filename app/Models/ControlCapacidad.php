<?php

namespace App\Models;

use App\Config\Database;
use PDO;
use PDOException;

class Controlcapacidad
{
    private $db;
    private $id;
    public $fecha_registro;
    public $planta_id;
    public $linea_id;
    public $proceso_id;
    public $turno_id;
    public $operario;
    public $horashombre;
    public $num_operarios;
    public function __construct()
    {
        error_log("Construyendo modelo Controlcapacidad");
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


    // Crear un nuevo registro
    public function create()
    {
        try {
            $query = "INSERT INTO control_capacidad (fecha_registro, planta_id, linea_id, proceso_id, turno_id, operario, horas_hombre, num_operarios)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->db->prepare($query);

            // Ejecutar la consulta
            $stmt->execute([
                $this->fecha_registro,
                $this->planta_id,
                $this->linea_id,
                $this->proceso_id,
                $this->turno_id,
                $this->operario,
                $this->horashombre,
                $this->num_operarios
            ]);

            // Retornar el ID del último registro insertado
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Error en la creación de registro: " . $e->getMessage());
            // throw new Exception("Error al crear el registro.");
        }
    }


    // Leer todos los registros
    public function readAll()
    {
        $query = "SELECT * FROM control_capacidad";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Leer un registro por ID
    public function readById($id)
    {
        $query = "SELECT * FROM control_capacidad WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un registro
    public function update($id)
    {
        $query = "UPDATE control_capacidad 
                      SET fecha_registro = ?, planta_id = ?, linea_id = ?, proceso_id = ?, turno_id = ?, operario = ?, horas_hombre = ?, num_operarios = ? 
                      WHERE id = ?";

        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            $this->fecha_registro,
            $this->planta_id,
            $this->linea_id,
            $this->proceso_id,
            $this->turno_id,
            $this->operario,
            $this->horashombre,
            $this->num_operarios,
            $id
        ]);
    }

    // Eliminar un registro
    public function delete($id)
    {
        $query = "DELETE FROM control_capacidad WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }
}
