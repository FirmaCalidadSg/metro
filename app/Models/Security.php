<?php

namespace App\Models;

use App\Config\Database;
use PDO;
class Security
{
    private $db;

    public function __construct() {
        error_log("Construyendo modelo Security");
        try {
            $this->db = Database::getInstance()->getConnection();
        } catch (\Exception $e) {
            error_log("Error de conexión: " . $e->getMessage());
            // Por ahora, continuamos sin base de datos
        }
    }

    public function login($username, $password) {
        error_log("Intento de login para usuario: " . $username);
        
        // Autenticación simple para pruebas
        if ($username === 'admin' && $password === '123456') {
            return [
                'success' => true,
                'user_id' => 1,
                'message' => 'Login exitoso'
            ];
        }

        return [
            'success' => false,
            'message' => 'Usuario o contraseña incorrectos'
        ];
    }

    public function createUser($username, $password) {
        try {
            // Verificar si el usuario ya existe
            $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            
            if ($stmt->fetch()) {
                return [
                    'success' => false,
                    'message' => 'El usuario ya existe'
                ];
            }

            // Crear nuevo usuario
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $this->db->prepare(
                "INSERT INTO users (username, password_hash, active, created_at) 
                 VALUES (?, ?, 1, GETDATE())"
            );
            
            $stmt->execute([$username, $passwordHash]);

            return [
                'success' => true,
                'message' => 'Usuario creado exitosamente'
            ];

        } catch (\PDOException $e) {
            error_log("Error creando usuario: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Error al crear el usuario'
            ];
        }
    }

    public function validateCSRFToken($token) {
        return isset($_SESSION['token']) && hash_equals($_SESSION['token'], $token);
    }

    private function validatePassword($password, $hash) {
        return password_verify($password, $hash);
    }

    public function getUserByUsername($username) {
        $query = "SELECT id, username, password FROM users WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllRoles() {
        $query = "SELECT id, rol FROM roles";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
