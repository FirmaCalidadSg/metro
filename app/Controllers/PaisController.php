<?php

namespace App\Controllers;


use App\Models\Pais;

class PaisController
{
    public $pais;

    public function __construct()
    {
        $this->pais = new Pais();
    }

    public function index()
    {

        $paises = $this->pais->getAllPais();

        require_once __DIR__ . '/../views/layouts/pais.php';
        require_once __DIR__ . '/../views/pais/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function registro()
    {
        $pais = new Pais();
        if (isset($_POST['id'])) {
            $pais = $this->pais->getPaisById($_POST['id']);
        }
        require_once __DIR__ . '/../views/layouts/register-pais.php';
        require_once __DIR__ . '/../views/pais/registro.php';
    }

    public function crear()
    {
        $message = 'Pais registrado exitosamente';
        $pais = new Pais();
        $pais->id = $_POST['id'];
        $pais->nombre = $_POST['nombre'];
        $pais->codigo = $_POST['codigo'];

        if ($pais->id > 0) {
            $this->pais->updatePais($pais);
            $message = 'Pais actualizado exitosamente';
        } else {
            $this->pais->createPais($pais);
        }
        $response = [
            'success' => true,
            'message' => $message
        ];
        echo json_encode($response);
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
        $codigo = $_POST['codigo'];
    
        // Obtener la definición por ID
        $pais = $this->pais->getPaisById($id);
    
        if (!$pais) {
            $response = [
                'success' => false,
                'message' => 'Pais no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }
    
        // Actualizar la definición
        $pais->nombre = $nombre;
        $pais->codigo = $codigo;
    
        // Guardar la definición actualizada
        $this->pais->updatePais($pais);
    
        $response = [
            'success' => true,
            'message' => 'Pais actualizado exitosamente.'
        ];
    
        echo json_encode($response);
    }
    public function editarFormulario($id)
    {
        $pais = $this->pais->getPaisById($id);
    
        if (!$pais) {
            $response = [
                'success' => false,
                'message' => 'Pais no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }
        require_once __DIR__ . '/../views/layouts/editar-pais.php';
        require_once __DIR__ . '/../views/pais/editar.php';
    }
    
    public function vistaPrevia($id)
    {
        if (isset($id)) {
            $pais = $this->pais->getPaisById($id);
        } else {
            header("Location: /metro/app/pais");
            exit;
        }
        require_once __DIR__ . '/../views/layouts/vista-previa-pais.php';
        require_once __DIR__ . '/../views/pais/vista-previa.php';
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

            // Eliminar el pais
            $this->pais->deletePais($id);

            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
