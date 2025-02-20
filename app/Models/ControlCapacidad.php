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
    public $producto_id;
    public $tiempoPerdidoIdeales;
    public $produccionIdeal;
    public $produccionIdealHora;
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


    public function guardarControlCapacidad(Controlcapacidad $controlcapacidad, $tabla)
    {
        try {
            // 1️⃣ Insertar en la tabla "control_capacidad"
            $sql = "INSERT INTO control_capacidad 
                    (fecha_registro, planta_id, linea_id, proceso_id, turno_id, operario, horas_hombre, num_operarios, producto_id, tiempoPerdidoIdeales, produccionIdeal, produccionIdealHora) 
                    VALUES 
                    (:fecha_registro, :planta_id, :linea_id, :proceso_id, :turno_id, :operario, :horashombre, :num_operarios, :producto_id, :tiempoPerdidoIdeales, :produccionIdeal, :produccionIdealHora)";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':fecha_registro', $controlcapacidad->fecha_registro);
            $stmt->bindParam(':planta_id', $controlcapacidad->planta_id);
            $stmt->bindParam(':linea_id', $controlcapacidad->linea_id);
            $stmt->bindParam(':proceso_id', $controlcapacidad->proceso_id);
            $stmt->bindParam(':turno_id', $controlcapacidad->turno_id);
            $stmt->bindParam(':operario', $controlcapacidad->operario);
            $stmt->bindParam(':horashombre', $controlcapacidad->horashombre);
            $stmt->bindParam(':num_operarios', $controlcapacidad->num_operarios);
            $stmt->bindParam(':producto_id', $controlcapacidad->producto_id);
            $stmt->bindParam(':tiempoPerdidoIdeales', $controlcapacidad->tiempoPerdidoIdeales);
            $stmt->bindParam(':produccionIdeal', $controlcapacidad->produccionIdeal);
            $stmt->bindParam(':produccionIdealHora', $controlcapacidad->produccionIdealHora);

            $stmt->execute();

            // Obtener el ID del registro insertado
            $control_capacidad_id = $this->db->lastInsertId();

            // 2️⃣ Insertar los datos de la tabla "paros" si hay registros
            if (!empty($tabla)) {
                foreach ($tabla as $paro) {
                    $sqlParo = "INSERT INTO paradas 
                                (control_capacidad_id, paro, subparo, razon, tiempo, descripcion) 
                                VALUES 
                                (:control_capacidad_id, :paro, :subparo, :razon, :tiempo, :descripcion)";

                    $stmtParo = $this->db->prepare($sqlParo);
                    $stmtParo->bindParam(':control_capacidad_id', $control_capacidad_id);
                    $stmtParo->bindParam(':paro', $paro['Paro']);
                    $stmtParo->bindParam(':subparo', $paro['SubParo']);
                    $stmtParo->bindParam(':razon', $paro['Razon']);
                    $stmtParo->bindParam(':tiempo', $paro['Tiempo']);
                    $stmtParo->bindParam(':descripcion', $paro['Descripcion']);

                    $stmtParo->execute();
                }
            }

            return $control_capacidad_id;
        } catch (Exception $e) {
            return false;
        }
    }

    public function Paradas($id)
    {
        try {
            $query = "SELECT 
                    pl.nombre_planta,
                    l.nombre AS linea,
                    p.nombre AS proceso,
                    t.turno,
                    pr.nombre AS producto,
                    cc.operario,
                    cc.fecha_registro,
                    cc.horas_hombre,
                    cc.num_operarios,
                    cc.tiempoPerdidoIdeales,
                    cc.produccionIdeal,
                    cc.produccionIdealHora     
                  FROM control_capacidad cc
                  left JOIN plantas pl ON cc.planta_id = pl.id
                  left JOIN linea l ON cc.linea_id = l.id
                  left JOIN proceso p ON cc.proceso_id = p.id
                  left JOIN turnos t ON cc.turno_id = t.id
                  left JOIN producto pr ON cc.producto_id = pr.id
                  WHERE cc.id =:id";

            // Preparar la consulta
            $stmt = $this->db->prepare($query);

            // Asignar parámetros y ejecutar
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Retornar los resultados
            return $stmt->fetch(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            // Manejo de errores
            error_log("Error en Paradas: " . $e->getMessage());
            return false; // Retornar false en caso de error
        }
    }
    public function TblParadas($id)
    {
        try {
            $query = "SELECT 
                    paro,subparo,razon, tiempo, descripcion, created    
                  FROM paradas                   
                  WHERE control_capacidad_id =:id";

            // Preparar la consulta
            $stmt = $this->db->prepare($query);

            // Asignar parámetros y ejecutar
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Retornar los resultados
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            // Manejo de errores
            error_log("Error en Paradas: " . $e->getMessage());
            return false; // Retornar false en caso de error
        }
    }


}
