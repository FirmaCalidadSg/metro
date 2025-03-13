<?php

namespace App\Controllers;


use App\Models\Departamento;
use App\Models\Pais;

class DepartamentoController
{
    public $departamento;
    public $pais;

    public function __construct()
    {
        $this->departamento = new Departamento();
        $this->pais = new Pais();
    }

    public function index()
    {        
        $departamentos = $this->departamento->getAllDepartamento();

        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/departamento/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';

    }

    public function registro()
    {
        $paises = $this->pais->getAllPais();
        $departamento = new Departamento();
        if (isset($_POST['id'])) {
            $departamento = $this->departamento->getDepartamentoById($_POST['id']);
        }
        require_once __DIR__ . '/../views/layouts/Sidebar2.php';
        require_once __DIR__ . '/../views/departamento/registro.php';

    }

    public function crear()
    {
        $message = 'Departamento registrada exitosamente';
        $departamento = new Departamento();
        $departamento->id = $_POST['id'];
        $departamento->nombre = $_POST['nombre'];
        $departamento->pais = $_POST['pais'];

        if ($departamento->id > 0) {
            $this->departamento->updateDepartamento($departamento);
            $message = 'Departamento actualizada exitosamente';
        } else {
            $this->departamento->createDepartamento($departamento);
        }
        $response = [
            'success' => true,
            'message' => $message
        ];
        echo json_encode($response);
    }
    public function vistaPrevia($id)
    {
        if (isset($id)) {
            $departamento = $this->departamento->getDepartamentoById($id);
        } else {
            header("Location: /metro/app/departamento");
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/departamento/vista-previa.php';
    }
    public function editarFormulario($id)
    {
        $departamento = $this->departamento->getDepartamentoById($id);
        $paises = $this->pais->getAllPais();
        if (!$departamento) {
            $response = [
                'success' => false,
                'message' => 'Departamento no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }
        
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/departamento/editar.php';
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
        $pais = $_POST['pais'];
    
        // Obtener la definición por ID
        $departamento = $this->departamento->getDepartamentoById($id);
    
        if (!$departamento) {
            $response = [
                'success' => false,
                'message' => 'Departamento no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }
    
       
        $departamento->nombre = $nombre;
        $departamento->pais = $pais;
    
        $this->departamento->updateDepartamento($departamento);
    
        $response = [
            'success' => true,
            'message' => 'Departamento actualizado exitosamente.'
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

            // Eliminar el departamento
            $this->departamento->deleteDepartamento($id);

            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
