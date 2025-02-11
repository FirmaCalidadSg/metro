<?php

namespace App\Controllers;


use App\Models\LineaProducto;
use App\Models\Plantas;
use App\Models\Proceso;
use App\Models\Linea;
use App\Models\Producto;

class LineaProductoController
{
    public $linea_producto;
    public $planta;
    public $proceso;
    public $linea;
    public $producto;

    public function __construct()
    {
        $this->planta = new Plantas();
        $this->proceso = new Proceso();
        $this->linea = new Linea();
        $this->producto = new Producto();
        $this->linea_producto = new LineaProducto();
    }

    public function index()
    {
        $lineas_producto = $this->linea_producto->getAllLineaProducto();

        require_once __DIR__ . '/../views/layouts/Sidebar.php';
        require_once __DIR__ . '/../views/lineaproducto/index.php';
    }

    public function registro()
    {
        $plantas = $this->planta->getAllPlantas();
        $linea_producto = new LineaProducto();
        if (isset($_POST['id'])) {
            $linea_producto = $this->linea_producto->getLineaProductoById($_POST['id']);
        }
        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/lineaproducto/registro.php';
        require_once __DIR__ . '/../views/layouts/footer.php';




    }


    public function crear()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'planta_id' => $_POST['planta_id'] ?? null,
                'proceso_id' => $_POST['proceso_id'] ?? null,
                'linea_id' => $_POST['linea_id'] ?? null,
                'producto_id' => $_POST['producto_id'] ?? null,
                'unidad' => $_POST['unidad'] ?? null,
                'peso' => $_POST['peso'] ?? null,
                'rendimiento' => $_POST['rendimiento'] ?? null,
                'produccion_ajustada' => $_POST['produccion_ajustada'] ?? null,
                'produccion_teorica' => $_POST['produccion_teorica'] ?? null
            ];

            if ($this->linea_producto->createLineaProducto($data)) {
                echo json_encode(["success" => true, "message" => "Registro guardado con éxito"]);
            } else {
                echo json_encode(["success" => false, "message" => "Error al guardar los datos"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Método no permitido"]);
        }

    }
    public function vistaPrevia($id)
    {
        if (isset($id)) {
            $linea_producto = $this->linea_producto->getLineaProductoById($id);
        } else {
            header("Location: /metro/app/lineaproducto");
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/lineaproducto/vista-previa.php';
    }
    public function editarFormulario($id = null)
    {
        $productos = $this->producto->getAllProducto();
        $lineas = $this->linea->getAllLinea();
        $linea_producto = $this->linea_producto->getLineaProductoById($id);
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/lineaproducto/editar.php';
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
        $linea = $_POST['linea'];
        $producto = $_POST['producto'];
        $capacidad_produccion = $_POST['capacidad_produccion'];

        $linea_producto = $this->linea_producto->getLineaProductoById($id);

        if (!$linea_producto) {
            $response = [
                'success' => false,
                'message' => 'Linea y/oProducto no encontrada.'
            ];
            echo json_encode($response);
            exit;
        }

        $linea_producto->linea = $linea;
        $linea_producto->producto = $producto;
        $linea_producto->capacidad_produccion = $capacidad_produccion;

        $this->linea_producto->updateLineaProducto($linea_producto);

        $response = [
            'success' => true,
            'message' => 'Linea y/o Producto actualizada exitosamente.'
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
