<?php

namespace App\Controllers;


use App\Models\Ciudad;
use App\Models\Pais;

class CiudadController
{
    public $ciudad;
    public $pais;

    public function __construct()
    {
        $this->ciudad = new Ciudad();
        $this->pais = new Pais();
    }

    public function index()
    {        
        $ciudades = $this->ciudad->getAllCiudad();

        require_once __DIR__ . '/../views/layouts/layout.php';
        require_once __DIR__ . '/../views/ciudad/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function registro()
    {
        $paises = $this->pais->getAllPais();
        $ciudad = new Ciudad();
        if (isset($_POST['id'])) {
            $ciudad = $this->ciudad->getCiudadById($_POST['id']);
        }
        require_once __DIR__ . '/../views/ciudad/registro.php';
    }

    public function crear()
    {
        $message = 'Ciudad registrada exitosamente';
        $ciudad = new Ciudad();
        $ciudad->id = $_POST['id'];
        $ciudad->nombre = $_POST['nombre'];
        $ciudad->pais = $_POST['pais'];
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
