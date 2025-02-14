<?php

namespace App\Controllers;

use App\Models\Ciudad;
use App\Models\Departamento;
use App\Models\Plantas;
use App\Models\Turno;
use App\Models\Controlcapacidad;
use App\Models\Producto;
use App\Models\LineaProducto;
use App\Models\TiposParos;

class ControlCapacidadController
{
    public $ciudad;
    public $departamento;
    public $planta;
    public $turnos;
    public $controlcapacidad;
    public $producto;
    public $linea_producto;
    public $paros;

    public function __construct()
    {
        $this->controlcapacidad = new Controlcapacidad();
        $this->ciudad = new Ciudad();
        $this->departamento = new Departamento();
        $this->planta = new Plantas();
        $this->turnos = new Turno();
        $this->producto = new Producto();
        $this->linea_producto = new LineaProducto();
        $this->paros = new TiposParos();
    }



    public function index()
    {
        $plantas = $this->planta->getAllPlantas();

        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/controlCapacidad/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function paradas()
    {
        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/controlCapacidad/paradas.php';
    }

    public function modal1()
    {
        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/controlCapacidad/modal1.php';
    }

    public function modal2()
    {
        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/controlCapacidad/modal2.php';
    }


    public function RegistroCtrlCap()
    {
        $data = $_POST;
        // print_r(json_encode($data));

        $control = new Controlcapacidad();
        $control->fecha_registro = $_POST['fechaRegistro'];
        $control->planta_id = $_POST['planta_id'];
        $control->linea_id = $_POST['linea_id'];
        $control->proceso_id = $_POST['proceso_id'];
        $control->turno_id = $_POST['turno_id'];
        $control->operario = $_POST['operarioLider'];
        $control->horashombre = $_POST['h_hombre'];
        $control->num_operarios = $_POST['num_operarios'];
        $result = $control->create();
        if ($result) {
            $result = [
                "id" => $result,
                "success" => true,
                "message" => "Registro creado exitosamente.",
            ];

            echo json_encode($result);
        }
    }

    public function productosBYPlantaLineaProceso()
    {

        $planta_id = $_POST['planta_id'];
        $linea_id = $_POST['linea_id'];
        $proceso_id = $_POST['proceso_id'];
        $productos = $this->producto->productosBYPlantaLineaProceso($planta_id, $linea_id, $proceso_id);
        echo json_encode($productos);
        // print_r($productos);
    }

    public function getlineaProducto()
    {
        try {
            // Validar que los parámetros necesarios estén presentes
            if (!isset($_REQUEST['plantaId'], $_REQUEST['procesoId'], $_REQUEST['lineaId'], $_REQUEST['productoId'])) {
                echo json_encode(["error" => "Faltan parámetros"]);
                return;
            }

            // Obtener y sanitizar los datos de la solicitud
            $data = [
                'planta_id' => filter_var($_REQUEST['plantaId'], FILTER_SANITIZE_NUMBER_INT),
                'proceso_id' => filter_var($_REQUEST['procesoId'], FILTER_SANITIZE_NUMBER_INT),
                'linea_id' => filter_var($_REQUEST['lineaId'], FILTER_SANITIZE_NUMBER_INT),
                'producto_id' => filter_var($_REQUEST['productoId'], FILTER_SANITIZE_NUMBER_INT),
            ];

            // Llamar al modelo para obtener los datos
            $resultado = $this->linea_producto->getlineaProducto($data);

            // Enviar respuesta en formato JSON
            echo json_encode($resultado);
        } catch (Exception $e) {
            error_log("Error en getlineaProducto: " . $e->getMessage());
            echo json_encode(["error" => "Error interno del servidor"]);
        }
    }




    function getParoByTipo()
    {
        $tipo = $_POST['tipoParo'];
        $dtiempo = match ($tipo) {
            'tpno' => 1,
            'tpam' => 2,
            'tpp' => 3,
            'tpv' => 4,
            'tpc' => 5,
            default => 'Desconocido',
        };

        $paros = $this->paros->getParosByTiempo($dtiempo);
        $mensaje = match ($tipo) {
            'tpno' => require_once __DIR__ . '/../views/controlCapacidad/Paradas/tpno.php',
            'tpam' => require_once __DIR__ . '/../views/controlCapacidad/Paradas/mantenimiento.php',
            'tpp' => require_once __DIR__ . '/../views/controlCapacidad/Paradas/proceso.php',
            'tpv' => require_once __DIR__ . '/../views/controlCapacidad/Paradas/velocidad.php',
            'tpc' => require_once __DIR__ . '/../views/controlCapacidad/Paradas/calidad.php',
            default => 'Desconocido',
        };
        // print_r($paros);
    }



    public function SubParo()
    {
        $subparos = $this->paros->getSubParosByParos($_POST['paro_id']);
        echo json_encode($subparos);
    }

    public function RazonParo()
    {
        $subparos = $this->paros->getRazonBySubParo($_POST['subparo_id']);
        echo json_encode($subparos);
    }

}
