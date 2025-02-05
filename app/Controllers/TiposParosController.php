<?php

namespace App\Controllers;


use App\Models\TiposParos;
use App\Models\SubCategoriaParos;


class TiposParosController
{
    public $TiposParos;
    public $categoriaParos;


    public function __construct()
    {
        $this->TiposParos = new TiposParos();
        $this->categoriaParos = new SubCategoriaParos();

    }

    public function index()
    {

        $TiposParos = $this->TiposParos->getAllTiposParos();

        require_once __DIR__ . '/../views/layouts/Sidebar.php';
        require_once __DIR__ . '/../views/TiposParos/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';

    }

    public function registro()
    {
        $TiposParos = new TiposParos();
        $categoriasParos =  $this->categoriaParos->getAllSubCategoriaParos();
        //print_r($_REQUEST['id']);
        if (isset($_REQUEST['id'])) {
            $TiposParos = $this->TiposParos->getTiposParosById($_REQUEST['id']);
        }
       
        require_once __DIR__ . '/../views/TiposParos/registro.php';
    }

    public function crear()
    {
        $message = 'Categoría de Paros registrada exitosamente';
        $TiposParos = new TiposParos();
        $TiposParos->id_tipo = $_POST['id_tipo'];
        $TiposParos->id_subcategoria = $_POST['id_subcategoria'];
        $TiposParos->nombre = $_POST['nombre'];
        $TiposParos->descripcion = $_POST['descripcion'];

        $result = $TiposParos->id_tipo > 0 ? $this->TiposParos->updateTiposParos($TiposParos) : $this->TiposParos->createTiposParos($TiposParos);
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
        $TiposParos = $this->TiposParos->getTiposParosById($id);
    
        if (!$TiposParos) {
            $response = [
                'success' => false,
                'message' => 'Paros no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }
    
        // Actualizar la definición
        $TiposParos->nombre = $nombre;
        $TiposParos->codigo = $codigo;
    
        // Guardar la definición actualizada
        $result = $this->TiposParos->updateTiposParos($TiposParos);
        echo json_encode($result, true);
    }
    public function editarFormulario($id)
    {
        $TiposParos = $this->TiposParos->getTiposParosById($id);
    
        if (!$TiposParos) {
            $response = [
                'success' => false,
                'message' => 'Paros no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/TiposParos/editar.php';
    }
    
    public function vistaPrevia($id)
    {
        if (isset($id)) {
            $TiposParos = $this->TiposParos->getTiposParosById($id);
        } else {
            header("Location: /metro/app/TiposParos");
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/TiposParos/vista-previa.php';
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
            $result = $this->TiposParos->deleteTiposParos($id);
            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
