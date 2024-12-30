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
        $definicion = new Definicion();
        if (isset($_POST['id'])) {
            $definicion = $this->definicion->getDefinicionById($_POST['id']);
        }
        require_once __DIR__ . '/../views/definicion/registro.php';
    }

    public function crear()
    {
        $message = 'Definicion registrado exitosamente';
        $definicion = new Definicion();
        $definicion->id = $_POST['id'];
        $definicion->nombre = $_POST['nombre'];
        $definicion->valor = $_POST['valor'];
        $definicion->descripcion = $_POST['descripcion'];

        if ($definicion->id > 0) {
            $this->definicion->updateDefinicion($definicion);
            $message = 'Definicion actualizado exitosamente';
        } else {
            $this->definicion->createDefinicion($definicion);
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

            // Eliminar el definicion
            $this->definicion->deleteDefinicion($id);

            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
