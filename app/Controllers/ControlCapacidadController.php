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
use App\Models\Equipo;

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
    public $equipo;

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
        $this->equipo = new Equipo();
    }



    public function index()
    {
        $plantas = $this->planta->getAllPlantas();
        $equipos = $this->equipo->getAllEquipoE();

        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/controlCapacidad/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function indexFecha()
    {
        $plantas = $this->planta->getAllPlantas();
        $equipos = $this->equipo->getAllEquipoE();

        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/controlCapacidad/IndexFecha.php';
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

        $productos = $this->producto->productosBYLineaProceso($proceso_id);
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
            'tpnof' => 1,
            default => 'Desconocido',
        };

        $paros = $this->paros->getParosByTiempo($dtiempo);
        $mensaje = match ($tipo) {
            'tpno' => require_once __DIR__ . '/../views/controlCapacidad/Paradas/tpno.php',
            'tpam' => require_once __DIR__ . '/../views/controlCapacidad/Paradas/mantenimiento.php',
            'tpp' => require_once __DIR__ . '/../views/controlCapacidad/Paradas/proceso.php',
            'tpv' => require_once __DIR__ . '/../views/controlCapacidad/Paradas/velocidad.php',
            'tpc' => require_once __DIR__ . '/../views/controlCapacidad/Paradas/calidad.php',
            'tpnof' => require_once __DIR__ . '/../views/controlCapacidad/Paradas/tpnof.php',
            default => 'Desconocido',
        };
        //  print_r($paros);
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



    public function procesarDatos()
    {
        try {
            // Obtener datos del JSON enviado desde AJAX
            $json = file_get_contents("php://input");
            $datos = json_decode($json, true); // Convertir a array asociativo

            if (!$datos) {
                echo json_encode(["status" => "error", "message" => "Datos inválidos"]);
                return;
            }

            // Extraer datos de cada parte
            $form1 = $this->convertirArrayAsociativo($datos['form1']);
            $form2 = $this->convertirArrayAsociativo($datos['form2']);
            $tabla = $datos['tabla']; // Ya está en formato array de objetos

            // Crear objeto de solicitud para enviar al modelo
            $solicitud = new Controlcapacidad();
            $solicitud->fecha_registro = $form1['fechaRegistro'] ?? null;
            $solicitud->planta_id = $form1['planta_id'] ?? null;
            $solicitud->linea_id = $form1['linea_id'] ?? null;
            $solicitud->proceso_id = $form1['proceso_id'] ?? null;
            $solicitud->operario = $form1['operarioLider'] ?? null;
            $solicitud->turno_id = $form1['turno_id'] ?? null;
            $solicitud->num_operarios = $form1['num_operarios'] ?? null;
            $solicitud->horashombre = $form1['h_hombre'] ?? null;

            // Datos del formulario "toForm"
            $solicitud->producto_id = $form2['producto_id'] ?? null;
            $solicitud->tiempoPerdidoIdeales = $form2['tiempoPerdidoIdealesInput'] ?? null;
            $solicitud->produccionIdeal = $form2['produccionIdeal'] ?? null;
            $solicitud->produccionIdealHora = $form2['produccionIdealHora'] ?? null;

            // Enviar datos al modelo
            $resultado = $this->controlcapacidad->guardarControlCapacidad($solicitud, $tabla);

            if ($resultado) {
                echo json_encode(["status" => "success", "message" => "Datos guardados correctamente", "cc" => $resultado]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al guardar"]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
    public function procesarDatosFecha()
    {
        try {
            // Obtener datos del JSON enviado desde AJAX
            $json = file_get_contents("php://input");
            $datos = json_decode($json, true); // Convertir a array asociativo

            if (!$datos) {
                echo json_encode(["status" => "error", "message" => "Datos inválidos"]);
                return;
            }

            // Extraer datos de cada parte
            $form1 = $this->convertirArrayAsociativo($datos['form1']);
            // $form2 = $this->convertirArrayAsociativo($datos['form2']);
            $tabla = $datos['tabla']; // Ya está en formato array de objetos

            // Crear objeto de solicitud para enviar al modelo
            $solicitud = new Controlcapacidad();
            $solicitud->fecha_registro = $form1['fechaRegistro'] ?? null;
            $solicitud->planta_id = $form1['planta_id'] ?? null;
            $solicitud->linea_id = $form1['linea_id'] ?? null;
            $solicitud->proceso_id = $form1['proceso_id'] ?? null;
            $solicitud->operario = $form1['operarioLider'] ?? null;
            $solicitud->turno_id = $form1['turno_id'] ?? null;
            $solicitud->num_operarios = $form1['num_operarios'] ?? null;
            $solicitud->horashombre = $form1['h_hombre'] ?? null;

            // Datos del formulario "toForm"
            $solicitud->producto_id =  0;
            $solicitud->tiempoPerdidoIdeales =  0;
            $solicitud->produccionIdeal =  0;
            $solicitud->produccionIdealHora =  0;

            // Enviar datos al modelo
            $resultado = $this->controlcapacidad->guardarControlCapacidad($solicitud, $tabla);

            if ($resultado) {
                echo json_encode(["status" => "success", "message" => "Datos guardados correctamente", "cc" => $resultado]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al guardar"]);
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    /**
     * Función auxiliar para convertir un array de [{name: "campo", value: "dato"}] a [campo => dato]
     */
    private function convertirArrayAsociativo($array)
    {
        $resultado = [];
        foreach ($array as $item) {
            if (isset($item['name']) && isset($item['value'])) {
                $resultado[$item['name']] = $item['value'];
            }
        }
        return $resultado;
    }

    public function ViewData($id)
    {
        $controlcapacidad = $this->controlcapacidad->Paradas($id);
        $paros = $this->controlcapacidad->TblParadas($id);
        $turno = $this->turnos->getTurnoByIds($controlcapacidad->turnoid);
        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/controlCapacidad/viewdata.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
