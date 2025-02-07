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
    public $hora_inicio;
    public $hora_fin;

    public function __construct()
    {
        error_log("Construyendo modelo Turno");
        try {
            $this->db = Database::getInstance()->getConnection();
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("SET NAMES utf8mb4");
        } catch (\Exception $e) {
            error_log("Error de conexión MySQL: " . $e->getMessage());
            throw new \Exception("No se pudo establecer la conexión con la base de datos");
        }
    }

    public function getAllTurnos()
    {
        $query = "SELECT t.id AS turno_id, t.turno, t.fecha_inicio, t.fecha_fin, t.hora_inicio, t.hora_fin, 
                         p.nombre_planta AS nombre_planta 
                  FROM turnos t 
                  JOIN plantas p ON t.planta_id = p.id;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTurnoById($id)
    {
        $query = "SELECT t.id AS turno_id, t.turno, t.fecha_inicio,t.planta_id, t.fecha_fin, t.hora_inicio, t.hora_fin, 
                         p.nombre_planta AS nombre_planta 
                  FROM turnos t 
                  JOIN plantas p ON t.planta_id = p.id
                  WHERE t.id = :id;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
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


    // public function createTurnos(Turnos $Turnos)
    public function createTurno(Turno $turno)
    {
        $query = "INSERT INTO turnos (turno, planta_id, fecha_inicio, fecha_fin, hora_inicio, hora_fin) 
                  VALUES (:nombre, :planta_id, :fecha_inicio, :fecha_fin, :hora_inicio, :hora_fin)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $turno->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':planta_id', $turno->planta_id, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_inicio', $turno->fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $turno->fecha_fin, PDO::PARAM_STR);
        $stmt->bindParam(':hora_inicio', $turno->hora_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':hora_fin', $turno->hora_fin, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'msn' => 'Turno registrado con éxito',
                'id' => $this->db->lastInsertId(),
            ];
        } else {
            return [
                'status' => 'error',
                'msn' => 'Error en el registro del turno',
            ];
        }
    }

    public function updateTurno(Turno $turno)
    {
        $query = "UPDATE turnos SET 
                    turno = :nombre, 
                    planta_id = :planta_id, 
                    fecha_inicio = :fecha_inicio, 
                    fecha_fin = :fecha_fin, 
                    hora_inicio = :hora_inicio, 
                    hora_fin = :hora_fin
                  WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $turno->id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $turno->nombre, PDO::PARAM_STR);
        $stmt->bindParam(':planta_id', $turno->planta_id, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_inicio', $turno->fecha_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin', $turno->fecha_fin, PDO::PARAM_STR);
        $stmt->bindParam(':hora_inicio', $turno->hora_inicio, PDO::PARAM_STR);
        $stmt->bindParam(':hora_fin', $turno->hora_fin, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return [
                'status' => 'success',
                'msn' => 'Turno actualizado con éxito',
                'id' => $turno->id,
            ];
        } else {
            return [
                'status' => 'error',
                'msn' => 'Error en la actualización del turno',
            ];
        }
    }

    public function deleteTurno($id)
    {
        $query = "DELETE FROM turnos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
