<?php

namespace App\Controllers;


use App\Models\LineaProducto;
use App\Models\Producto;
use App\Models\Linea;

class LineaProductoController
{
    public $linea_producto;
    public $producto;
    public $linea;

    public function __construct()
    {
        $this->linea_producto = new LineaProducto();
        $this->producto = new Producto();
        $this->linea = new Linea();
    }

    public function index()
    {        
        $lineas_producto = $this->linea_producto->getAllLineaProducto();

        require_once __DIR__ . '/../views/layouts/layout.php';
        require_once __DIR__ . '/../views/lineaproducto/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function registro()
    {
        $productos = $this->producto->getAllProducto();
        $lineas = $this->linea->getAllLinea();
        $linea_producto = new LineaProducto();
        if (isset($_POST['id'])) {
            $linea_producto = $this->linea_producto->getLineaProductoById($_POST['id']);
        }
        require_once __DIR__ . '/../views/lineaproducto/registro.php';
    }

    public function crear()
    {
        $message = 'Linea Producto registrada exitosamente';
        $linea_producto = new LineaProducto();
        $linea_producto->id = $_POST['id'];
        $linea_producto->linea = $_POST['linea'];
        $linea_producto->producto = $_POST['producto'];
        $linea_producto->capacidad_produccion = $_POST['capacidad_produccion'];

        if ($linea_producto->id > 0) {
            $this->linea_producto->updateLineaProducto($linea_producto);
            $message = 'Linea Producto actualizada exitosamente';
        } else {
            $this->linea_producto->createLineaProducto($linea_producto);
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

            // Eliminar el linea_producto
            $this->linea_producto->deleteLineaProducto($id);

            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
