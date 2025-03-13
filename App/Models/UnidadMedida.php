<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class UnidadMedida
{
    private $db;

    public $id;
    public $unidad;

    public function __construct()
    {
        error_log("Construyendo modelo UnidadMedida");
        try {
            $this->db = Database::getInstance()->getConnection();
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("SET NAMES utf8mb4");
        } catch (\Exception $e) {
            error_log("Error de conexión MySQL: " . $e->getMessage());
            throw new \Exception("No se pudo establecer la conexión con la base de datos");
        }
    }

    public function getAllUnidadesMedida()
    {
        $query = "SELECT * FROM unidades_medida";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getUnidadMedidaById($id)
    {
        $query = "SELECT * FROM unidades_medida WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createUnidadMedida(UnidadMedida $unidad)
    {
        $query = "INSERT INTO unidades_medida (unidad) VALUES (:unidad)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':unidad', $unidad->unidad, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'msn' => 'Unidad de medida registrada con éxito',
                'id' => $this->db->lastInsertId(),
            ];
        } else {
            return [
                'status' => 'error',
                'msn' => 'Error en el registro de la unidad de medida',
            ];
        }
    }

    public function updateUnidadMedida(UnidadMedida $unidad)
    {
        $query = "UPDATE unidades_medida SET unidad = :unidad WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $unidad->id, PDO::PARAM_INT);
        $stmt->bindParam(':unidad', $unidad->unidad, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'msn' => 'Unidad de medida actualizada con éxito',
                'id' => $unidad->id,
            ];
        } else {
            return [
                'status' => 'error',
                'msn' => 'Error en la actualización de la unidad de medida',
            ];
        }
    }

    public function deleteUnidadMedida($id)
    {
        $query = "DELETE FROM unidades_medida WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
