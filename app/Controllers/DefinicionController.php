<?php

namespace App\Controllers;


use App\Models\Definicion;

class DefinicionController
{
    public $definicion;

    public function __construct()
    {
        $this->definicion = new Definicion();
    }

    public function index()
    {

        $definicion = $this->definicion->getAllDefinicion();
        // var_dump($definicion);
        require_once __DIR__ . '/../views/layouts/definicion.php';
        require_once __DIR__ . '/../views/definicion/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function registro()
    {
        $modo = 'crear'; 
        $definicion = null;  
    
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $definicion = $this->definicion->getDefinicionById($_POST['id']);
            $modo = 'editar'; 
        }
      
        require_once __DIR__ . '/../views/layouts/register-defi.php';
        require_once __DIR__ . '/../views/definicion/registro.php';
    }
    
    

    public function crear()
    {
        $message = 'Definicion registrada exitosamente';
        $definicion = new Definicion();
        $definicion->id = $_POST['id'];
        $definicion->nombre = $_POST['nombre'];
        $definicion->valor = $_POST['valor'];
        $definicion->descripcion = $_POST['descripcion'];
    
        if ($definicion->id > 0) {
            $this->definicion->updateDefinicion($definicion);
            $message = 'Definicion actualizada exitosamente';
        } else {
            $this->definicion->createDefinicion($definicion);
        }
    
        $response = [
            'success' => true,
            'message' => $message
        ];
        
        // Enviamos la respuesta en formato JSON para que el frontend lo procese
        echo json_encode($response);
    }
    public function vistaPrevia($id)
    {
        if (isset($id)) {
            $definicion = $this->definicion->getDefinicionById($id);
        } else {
            header("Location: /metro/app/definicion");
            exit;
        }
        require_once __DIR__ . '/../views/layouts/vista-previa-definicion.php';
        require_once __DIR__ . '/../views/definicion/vistaPrevia.php';
    }
    public function editarFormulario($id)
    {
        $definicion = $this->definicion->getDefinicionById($id);
    
        if (!$definicion) {
            $response = [
                'success' => false,
                'message' => 'Definición no encontrada.'
            ];
            echo json_encode($response);
            exit;
        }
        require_once __DIR__ . '/../views/layouts/editar-definiciones.php';
        require_once __DIR__ . '/../views/definicion/editar.php';
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
        $valor = $_POST['valor'];
        $descripcion = $_POST['descripcion'];
    
        // Obtener la definición por ID
        $definicion = $this->definicion->getDefinicionById($id);
    
        if (!$definicion) {
            $response = [
                'success' => false,
                'message' => 'Definición no encontrada.'
            ];
            echo json_encode($response);
            exit;
        }
    
        // Actualizar la definición
        $definicion->nombre = $nombre;
        $definicion->valor = $valor;
        $definicion->descripcion = $descripcion;
    
        // Guardar la definición actualizada
        $this->definicion->updateDefinicion($definicion);
    
        $response = [
            'success' => true,
            'message' => 'Definición actualizada exitosamente.'
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

            // Eliminar el definicion
            $this->definicion->deleteDefinicion($id);

            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
