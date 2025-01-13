<?php

namespace App\Controllers;


use App\Models\Ciudad;
use App\Models\Departamento;

class CiudadController
{
    public $ciudad;
    public $departamento;

    public function __construct()
    {
        $this->ciudad = new Ciudad();
        $this->departamento = new Departamento();
    }

    public function index()
    {
        $ciudades = $this->ciudad->getAllCiudad();

        require_once __DIR__ . '/../views/layouts/Sidebar.php';
        require_once __DIR__ . '/../views/ciudad/index.php';
    }

    public function registro()
    {
        $departamentos = $this->departamento->getAllDepartamento();
        $ciudad = new Ciudad();
        if (isset($_POST['id'])) {
            $ciudad = $this->ciudad->getCiudadById($_POST['id']);
        }
        require_once __DIR__ . '/../views/layouts/Sidebar2.php';
        require_once __DIR__ . '/../views/ciudad/registro.php';
    }
    public function vistaPrevia($id)
    {
        if (isset($id)) {
            $ciudad = $this->ciudad->getCiudadById($id);
        } else {
            header("Location: /metro/app/ciudad");
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/ciudad/vista-previa.php';
    }
    
    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $response = [
                'success' => false,
                'message' => 'Método no permitido.'
            ];
            echo json_encode($response);
            exit;
        }
    
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $departamento = $_POST['departamento'];
        $codigo_postal = $_POST['codigo_postal'];
    
        // Obtener la definición por ID
        $ciudad = $this->ciudad->getCiudadById($id);
    
        if (!$ciudad) {
            $response = [
                'success' => false,
                'message' => 'Ciudad no encontrada.'
            ];
            echo json_encode($response);
            exit;
        }
    
        // Actualizar la definición
        $ciudad->nombre = $_POST['nombre'];
        $ciudad->departamento = $_POST['departamento'];
        $ciudad->codigo_postal = $_POST['codigo_postal'];
    
        // Guardar la definición actualizada
        $this->ciudad->updateCiudad($ciudad);
    
        $response = [
            'success' => true,
            'message' => 'Ciudad actualizada exitosamente.'
        ];
    
        echo json_encode($response);
    }
    public function editarFormulario($id)
    {
        $departamentos = $this->departamento->getAllDepartamento();
        $ciudad = $this->ciudad->getCiudadById($id);
    
        if (!$ciudad) {
            $response = [
                'success' => false,
                'message' => 'Ciudad no encontrada.'
            ];
            echo json_encode($response);
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/ciudad/editar.php';
    }
    

    public function crear()
    {
        $message = 'Ciudad registrada exitosamente';
        $ciudad = new Ciudad();
        $ciudad->id = $_POST['id'];
        $ciudad->nombre = $_POST['nombre'];
        $ciudad->departamento = $_POST['departamento'];
        $ciudad->codigo_postal = $_POST['codigo_postal'];

        if ($ciudad->id > 0) {
            $this->ciudad->updateCiudad($ciudad);
            $message = 'Ciudad actualizada exitosamente';
        } else {
            $this->ciudad->createCiudad($ciudad);
        }
        $response = [
            'success' => true,
            'message' => $message
        ];
        echo json_encode($response);
    }
    public function eliminar($id = null)
    {
        try {
            // Verificar si el ID viene en la URL
            if ($id === null) {
                // Si no viene en la URL, intentar obtenerlo del POST
                $data = json_decode(file_get_contents('php://input'), true);
                $id = $data['id'] ?? null;
            }

            if ($id === null) {
                throw new \Exception('ID no proporcionado');
            }

            // Eliminar el ciudad
            $this->ciudad->deleteCiudad($id);

            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
