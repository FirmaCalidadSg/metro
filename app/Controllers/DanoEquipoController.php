<?php

namespace App\Controllers;


use App\Models\DanoEquipo;
use App\Models\Equipo;

class DanoEquipoController
{
    public $dano;
    public $equipo;

    public function __construct()
    {
        $this->dano = new DanoEquipo();
        $this->equipo = new Equipo();
    }

    public function index()
    {        
        $danos = $this->dano->getAllDanoEquipo();

        require_once __DIR__ . '/../views/layouts/layout.php';
        require_once __DIR__ . '/../views/danoequipo/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function registro()
    {
        $equipos = $this->equipo->getAllEquipo();
        $dano = new DanoEquipo();
        if (isset($_POST['id'])) {
            $dano = $this->dano->getDanoEquipoById($_POST['id']);
        }
        require_once __DIR__ . '/../views/danoequipo/registro.php';
    }

    public function crear()
    {
        $message = 'DanoEquipo registrada exitosamente';
        $dano = new DanoEquipo();
        $dano->id = $_POST['id'];
        $dano->descripcion = $_POST['descripcion'];
        $dano->equipo = $_POST['equipo'];
        $dano->fecha = $_POST['fecha'];
        $dano->estado = $_POST['estado'];

        if ($dano->id > 0) {
            $this->dano->updateDanoEquipo($dano);
            $message = 'DanoEquipo actualizada exitosamente';
        } else {
            $this->dano->createDanoEquipo($dano);
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

            // Eliminar el dano
            $this->dano->deleteDanoEquipo($id);

            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
