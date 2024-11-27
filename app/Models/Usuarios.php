<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Usuarios
{
    private $db;
    public $id;
    public $credencial;
    public $identificacion;
    public $apellidos;
    public $nombres;
    public $usuario;
    public $rol_id;
    public function __construct()
    {
        error_log("Construyendo modelo Usuarios");
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


    public function getAllUsuarios()
    {
        $query = "SELECT * FROM usuarios";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getUsuarioById($id)
    {
        $query = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function createUsuario(Usuarios $usuario)
    {
        // var_dump($usuario);

        $query = "INSERT INTO usuarios (apellidos, nombres, usuario, credencial, rol_id, identificacion) VALUES (:apellidos, :nombres, :usuario, :credencial, :rol_id, :identificacion)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':apellidos', $usuario->apellidos, PDO::PARAM_STR);
        $stmt->bindParam(':nombres', $usuario->nombres, PDO::PARAM_STR);
        $stmt->bindParam(':usuario', $usuario->usuario, PDO::PARAM_STR);
        $stmt->bindParam(':credencial', $usuario->credencial, PDO::PARAM_STR);
        $stmt->bindParam(':rol_id', $usuario->rol_id, PDO::PARAM_STR);
        $stmt->bindParam(':identificacion', $usuario->identificacion, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateUsuario(Usuarios $usuario)
    {
        $query = "UPDATE usuarios SET 
            apellidos = :apellidos, 
            nombres = :nombres, 
            identificacion = :identificacion, 
            rol_id = :rol_id 
            WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $usuario->id, PDO::PARAM_INT);
        $stmt->bindParam(':apellidos', $usuario->apellidos, PDO::PARAM_STR);
        $stmt->bindParam(':nombres', $usuario->nombres, PDO::PARAM_STR);
        $stmt->bindParam(':identificacion', $usuario->identificacion, PDO::PARAM_STR);
        $stmt->bindParam(':rol_id', $usuario->rol_id, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function updateCredenciales(Usuarios $usuario)
    {
        $query = "UPDATE usuarios SET 
            usuario = :usuario, 
            credencial = :credencial 
            WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $usuario->id, PDO::PARAM_INT);
        $stmt->bindParam(':usuario', $usuario->usuario, PDO::PARAM_STR);
        $stmt->bindParam(':credencial', $usuario->credencial, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteUsuario($id)
    {
        $query = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
