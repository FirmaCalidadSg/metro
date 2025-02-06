<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Turno
{
    private $db;
    public $id;
    public $nombre;
    public $planta_id;
    public $fecha_inicio;
    public $fecha_fin;
    public $hora_fin;
    public $hora_inicio;
    public $planta;
    public function __construct()
    {
        error_log("Construyendo modelo Turnos");
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


    public function getAllTurnos()
    {
        $query = "SELECT t.id as turno_id, turno,fecha_inicio, fecha_fin,hora_inicio,hora_fin, p.nombre_planta
        FROM turnos t 
        JOIN plantas p ON t.planta_id = p.id
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getTurnosById($id)
    {
        $query = "SELECT t.id as turno_id, turno,fecha_inicio, fecha_fin,hora_inicio,hora_fin, p.nombre_planta
        FROM turnos t 
        JOIN plantas p ON t.planta_id = p.id
        WHERE t.planta_id=:id
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result; 
    }

    public function getTurno($id)
    {
        $query = "SELECT t.id as turno_id, turno,fecha_inicio, fecha_fin,hora_inicio,hora_fin, p.nombre_planta
        FROM turnos t 
        JOIN plantas p ON t.planta_id = p.id
        WHERE t.id=:id
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result; 
    }


    public function createTurnos(Turnos $Turnos)
    {
        $query = "INSERT INTO Turnos (nombre, departamento, codigo_postal) VALUES (:nombre, :departamento, :codigo_postal)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $Turnos->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':departamento', $Turnos->departamento, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_postal', $Turnos->codigo_postal, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateTurnos(Turnos $Turnos)
    {
        $query = "UPDATE Turnos SET 
            nombre = :nombre, 
            departamento = :departamento,
            codigo_postal = :codigo_postal
            WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $Turnos->id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $Turnos->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':departamento', $Turnos->departamento, PDO::PARAM_STR);
        $stmt->bindParam(':codigo_postal', $Turnos->codigo_postal, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteTurnos($id)
    {
        $query = "DELETE FROM Turnos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
