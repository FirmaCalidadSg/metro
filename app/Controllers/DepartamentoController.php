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

        require_once __DIR__ . '/../views/layouts/departamento.php';
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
