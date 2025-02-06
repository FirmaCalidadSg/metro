<?php

namespace App\Controllers;


use App\Models\Producto;
use App\Models\Proceso;
use App\Models\Linea;
use App\Models\Planta;
use App\Models\Plantas;

class ProductoController
{
    public $producto;
    public $proceso;
    public $linea;
    public $planta;

    public function __construct()
    {
        $this->producto = new Producto();
        $this->proceso = new Proceso();
        $this->linea = new Linea();
        $this->planta = new Plantas();
    }

    public function index()
    {
        $productos = $this->producto->getAllProducto();
        require_once __DIR__ . '/../views/layouts/Sidebar2.php';
        require_once __DIR__ . '/../views/producto/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function registro()
    {
        $producto = new Producto();
        if (isset($_POST['id'])) {
            $producto = $this->producto->getProductoById($_POST['id']);
        }
        $plantas = $this->planta->getAllPlantas();
        $lineas = $this->linea->getAllLinea();
        $procesos = $this->proceso->getAllProceso();


        // print_r($plantas);
        // print_r($lineas);
        // print_r($procesos);
        require_once __DIR__ . '/../views/layouts/Sidebar2.php';
        require_once __DIR__ . '/../views/producto/registro.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function agregarproducto()
    {
        require_once __DIR__ . '/../views/producto/agregarprodcontrol.php';
    }

    public function crear()
    {
        $message = 'Producto registrado exitosamente';
        $producto = new Producto();
        $producto->id = $_POST['id'];
        $producto->nombre = $_POST['nombre'];
        $producto->planta_id = $_POST['planta'];
        $producto->proceso_id = $_POST['proceso'];
        $producto->linea_id = $_POST['linea'];
        $producto->nombre = $_POST['nombre'];
        $producto->codigo = $_POST['codigo'];
        $producto->descripcion = $_POST['descripcion'];

        if ($producto->id > 0) {
            $this->producto->updateProducto($producto);
            $message = 'Producto actualizado exitosamente';
        } else {
            $this->producto->createProducto($producto);
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
            $producto = $this->producto->getProductoById($id);
        } else {
            header("Location: /metro/app/producto");
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/producto/vista-previa.php';
    }
    public function editarFormulario($id = null)
    {
        if (isset($id)) {
            $producto = $this->producto->getProductoById($id);
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/producto/editar.php';
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
        $descripcion = $_POST['descripcion'];

        $producto = $this->producto->getProductoById($id);

        if (!$producto) {
            $response = [
                'success' => false,
                'message' => 'Producto no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }

        $producto->nombre = $nombre;
        $producto->codigo = $codigo;
        $producto->descripcion = $descripcion;

        $this->producto->updateProducto($producto);

        $response = [
            'success' => true,
            'message' => 'Producto actualizado exitosamente.'
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

            // Eliminar el producto
            $this->producto->deleteProducto($id);

            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
