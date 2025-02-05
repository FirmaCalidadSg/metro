<?php

namespace App\Controllers;


use App\Models\SubCategoriaParos;
use App\Models\CategoriaParos;


class SubCategoriaParosController
{
    public $SubCategoriaParos;
    public $categoriaParos;


    public function __construct()
    {
        $this->SubCategoriaParos = new SubCategoriaParos();
        $this->categoriaParos = new CategoriaParos();

    }

    public function index()
    {

        $SubCategoriaParos = $this->SubCategoriaParos->getAllSubCategoriaParos();

        require_once __DIR__ . '/../views/layouts/Sidebar.php';
        require_once __DIR__ . '/../views/SubCategoriaParos/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';

    }

    public function registro()
    {
        $SubCategoriaParos = new SubCategoriaParos();
        $categoriasParos =  $this->categoriaParos->getAllCategoriaParos();
        //print_r($_REQUEST['id']);
        if (isset($_REQUEST['id'])) {
            $SubCategoriaParos = $this->SubCategoriaParos->getSubCategoriaParosById($_REQUEST['id']);
        }
       
        require_once __DIR__ . '/../views/SubCategoriaParos/registro.php';
    }

    public function crear()
    {
        $message = 'Categoría de Paros registrada exitosamente';
        $SubCategoriaParos = new SubCategoriaParos();
        $SubCategoriaParos->id_subcategoria = $_POST['id'];
        $SubCategoriaParos->id_categoria = $_POST['id_categoria'];
        $SubCategoriaParos->nombre = $_POST['nombre'];
        $SubCategoriaParos->descripcion = $_POST['descripcion'];

        $result = $SubCategoriaParos->id_subcategoria > 0 ? $this->SubCategoriaParos->updateSubCategoriaParos($SubCategoriaParos) : $this->SubCategoriaParos->createSubCategoriaParos($SubCategoriaParos);
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
        $SubCategoriaParos = $this->SubCategoriaParos->getSubCategoriaParosById($id);
    
        if (!$SubCategoriaParos) {
            $response = [
                'success' => false,
                'message' => 'Paros no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }
    
        // Actualizar la definición
        $SubCategoriaParos->nombre = $nombre;
        $SubCategoriaParos->codigo = $codigo;
    
        // Guardar la definición actualizada
        $result = $this->SubCategoriaParos->updateSubCategoriaParos($SubCategoriaParos);
        echo json_encode($result, true);
    }
    public function editarFormulario($id)
    {
        $SubCategoriaParos = $this->SubCategoriaParos->getSubCategoriaParosById($id);
    
        if (!$SubCategoriaParos) {
            $response = [
                'success' => false,
                'message' => 'Paros no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/SubCategoriaParos/editar.php';
    }
    
    public function vistaPrevia($id)
    {
        if (isset($id)) {
            $SubCategoriaParos = $this->SubCategoriaParos->getSubCategoriaParosById($id);
        } else {
            header("Location: /metro/app/SubCategoriaParos");
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/SubCategoriaParos/vista-previa.php';
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
            $result = $this->SubCategoriaParos->deleteSubCategoriaParos($id);
            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
