<?php

namespace App\Controllers;


use App\Models\CategoriaParos;
use App\Models\DistribucionTiempos;


class CategoriaParosController
{
    public $categoriaParos;
    public $tiempo;

    public function __construct()
    {
        $this->categoriaParos = new CategoriaParos();
        $this->tiempo = new DistribucionTiempos();
    }

    public function index()
    {

        $categoriaParos = $this->categoriaParos->getAllCategoriaParos();

        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/categoriaParos/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';

    }

    public function registro()
    {
        $categoriaParos = new CategoriaParos();
        $distribucion = $this->tiempo->getAllDistribucionTiempos();

        //print_r($_REQUEST['id']);
        if (isset($_REQUEST['id'])) {
            $categoriaParos = $this->categoriaParos->getCategoriaParosById($_REQUEST['id']);
        }
       
        require_once __DIR__ . '/../views/categoriaParos/registro.php';
    }

    public function crear()
    {
        $message = 'Categoría de Paros registrada exitosamente';
        $categoriaParos = new CategoriaParos();
        $categoriaParos->id_categoria = $_POST['id'];
        $categoriaParos->id_distribucion = $_POST['id_distribucion'];
        $categoriaParos->nombre = $_POST['nombre'];
        $categoriaParos->descripcion = $_POST['descripcion'];

        $result = $categoriaParos->id_categoria > 0 ? $this->categoriaParos->updateCategoriaParos($categoriaParos) : $this->categoriaParos->createCategoriaParos($categoriaParos);
        echo json_encode($result, true);
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
        $categoriaParos = $this->categoriaParos->getCategoriaParosById($id);
    
        if (!$categoriaParos) {
            $response = [
                'success' => false,
                'message' => 'Paros no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }
    
        // Actualizar la definición
        $categoriaParos->nombre = $nombre;
        $categoriaParos->codigo = $codigo;
    
        // Guardar la definición actualizada
        $result = $this->categoriaParos->updateCategoriaParos($categoriaParos);
        echo json_encode($result, true);
    }
    public function editarFormulario($id)
    {
        $categoriaParos = $this->categoriaParos->getCategoriaParosById($id);
    
        if (!$categoriaParos) {
            $response = [
                'success' => false,
                'message' => 'Paros no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/CategoriaParos/editar.php';
    }
    
    public function vistaPrevia($id)
    {
        if (isset($id)) {
            $categoriaParos = $this->categoriaParos->getCategoriaParosById($id);
        } else {
            header("Location: /metro/app/categoriaParos");
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/CategoriaParos/vista-previa.php';
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

            // Eliminar el paros
            $result = $this->categoriaParos->deleteCategoriaParos($id);
            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
