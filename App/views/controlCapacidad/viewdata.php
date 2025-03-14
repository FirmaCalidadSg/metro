<?php
// print_r($turno);
?>
<!-- <div class="container mt-1"> -->
<div class="card">
    <div class="card-header">
        <div class="text">
            <div class="text-wrapper">Registro control de capacidad</div>
        </div>
        <div class="float-right">
            <div class="frame-2">
                <div class="text-wrapper-2">Supervisor</div>
                <div class="div-wrapper">
                    <div class="text-wrapper-3"><strong><?php echo ucwords($controlcapacidad->operario) ?></strong>
                    </div>
                </div>
            </div>
            <div class="frame-2">
                <div class="text-wrapper-2">Fecha registro</div>
                <div class="frame-3">
                    <i class="fa fa-calendar"></i>
                    <div class="text-wrapper-3">
                        <?php echo $controlcapacidad->fecha_registro ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row ">
            <div class="col-md-12">
                <div class="consultas-capacidad info-capacidad">
                    <div class="text-wrapper-5">Información general</div>
                    <div class="drops-downs">
                        <div class="element">
                            <div class="textfield">
                                <div class="input">
                                    <div class="text-wrapper-6">Fecha de registro</div>
                                    <div class="text-wrapper-3"><?php echo $controlcapacidad->fecha_registro ?></div>
                                    <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                                </div>
                            </div>
                            <div class="textfield-2">
                                <div class="input">
                                    <div class="text-wrapper-6">Planta</div>
                                    <div class="text-wrapper-3"><?php echo $controlcapacidad->nombre_planta ?></div>
                                    <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                                </div>
                            </div>
                        </div>
                        <div class="element">
                            <div class="textfield-2">
                                <div class="input">
                                    <div class="text-wrapper-6">Linea</div>
                                    <div class="text-wrapper-3"><?php echo $controlcapacidad->linea ?></div>
                                    <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                                </div>
                            </div>
                            <div class="textfield-2">
                                <div class="input">
                                    <div class="text-wrapper-6">Proceso</div>
                                    <div class="text-wrapper-3"><?php echo $controlcapacidad->proceso ?></div>
                                    <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                                </div>
                            </div>
                        </div>
                        <div class="element">
                            <div class="textfield-2">
                                <div class="input">
                                    <div class="text-wrapper-6">Nombre del operario líder</div>
                                    <div class="text-wrapper-3"><?php echo $controlcapacidad->operario ?></div>
                                    <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                                </div>
                            </div>
                            <div class="textfield-2">
                                <div class="input">
                                    <div class="text-wrapper-6">No. de operarios</div>
                                    <div class="text-wrapper-3"><?php echo $controlcapacidad->num_operarios ?></div>
                                    <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                                </div>
                            </div>
                        </div>
                        <div class="element">
                            <div class="textfield-2">
                                <div class="input">
                                    <div class="text-wrapper-6">No. horas hombre</div>
                                    <div class="text-wrapper-3"><?php echo $controlcapacidad->horas_hombre ?></div>
                                    <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                                </div>
                            </div>
                            <div class="textfield-2">
                                <div class="input">
                                    <div class="text-wrapper-6">Turno</div>
                                    <div class="text-wrapper-3"><?php echo $controlcapacidad->turno ?></div>
                                    <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($controlcapacidad->producto != 0): ?>
                <div class="col-md-12 text-center ">
                    <div class=" info-capacidad consultas-capacidad">
                        <div class="frame-5">
                            <div class="text-wrapper-10">Tiempo de operación</div>
                        </div>
                        <div class="operacion">
                            <div class="drops-downs">
                                <div class="element">
                                    <div class="textfield-2">
                                        <div class="input">
                                            <div class="text-wrapper-6">Producto</div>
                                            <div class="text-wrapper-19">
                                                <?php echo ucwords($controlcapacidad->producto) ?>
                                            </div>
                                            <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                                        </div>
                                    </div>
                                    <div class="textfield-2">
                                        <div class="input">
                                            <div class="text-wrapper-6">Hora inicial</div>
                                            <div class="text-wrapper-19"><?php echo $turno->hora_inicio ?></div>
                                            <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                                        </div>
                                    </div>
                                </div>
                                <div class="element-2">
                                    <div class="textfield-2">
                                        <div class="input">
                                            <div class="text-wrapper-6">Hora final</div>
                                            <div class="text-wrapper-19"><?php echo $turno->hora_fin ?></div>
                                            <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                                        </div>
                                    </div>
                                    <div class="textfield-2">
                                        <div class="input">
                                            <div class="text-wrapper-6">Tiempo total</div>
                                            <div class="text-wrapper-19"><?php
                                                                            // Supongamos que $turno es un objeto con propiedades hora_inicio y hora_fin
                                                                            $hora_inicio = new DateTime($turno->hora_inicio); // Convierte a DateTime
                                                                            $hora_fin = new DateTime($turno->hora_fin); // Convierte a DateTime

                                                                            // Calcula la diferencia en segundos
                                                                            $diferencia_segundos = $hora_fin->getTimestamp() - $hora_inicio->getTimestamp();

                                                                            // Convierte la diferencia a minutos
                                                                            $diferencia_minutos = $diferencia_segundos / 60;

                                                                            // Muestra la diferencia en minutos
                                                                            echo $diferencia_minutos;

                                                                            ?></div>
                                            <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                                        </div>
                                    </div>
                                </div>
                                <div class="element">
                                    <div class="textfield-2">
                                        <div class="input">
                                            <div class="text-wrapper-6">Producción conforme</div>
                                            <div class="text-wrapper-19">500</div>
                                            <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                                        </div>
                                    </div>
                                    <div class="textfield-2">
                                        <div class="input">
                                            <div class="text-wrapper-6">Reproceso</div>
                                            <div class="text-wrapper-19">50</div>
                                            <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-12 bg-white mt-1">
                                <div class="datos bg-white">
                                    <div class="element-3">
                                        <div class="frame-6 bg-white">
                                            <div class="text-wrapper-13">Tiempo por perdida ideales:</div>
                                        </div>
                                        <div class="text-wrapper-14"><?php echo $controlcapacidad->tiempoPerdidoIdeales ?>
                                            MIN
                                        </div>
                                    </div>
                                    <div class="element-3">
                                        <div class="frame-6 bg-white">
                                            <div class="text-wrapper-13">Tiempo por perdida reales:</div>
                                        </div>
                                        <div class="text-wrapper-14">PENDIENTE</div>
                                    </div>
                                    <div class="element-3">
                                        <div class="frame-6 bg-white">
                                            <div class="text-wrapper-13">Producción ideal:</div>
                                        </div>
                                        <div class="text-wrapper-14">
                                            <?php echo number_format($controlcapacidad->produccionIdeal) ?> KG
                                        </div>
                                    </div>
                                    <div class="element-3">
                                        <div class="frame-6 bg-white">
                                            <div class="text-wrapper-13">Producción ideal por hora:</div>
                                        </div>
                                        <div class="text-wrapper-14"><?php echo $controlcapacidad->produccionIdealHora ?> KG
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-md-12 mt-1" id="table">
                <?php if ($controlcapacidad->producto != 0): ?>
                    <table class="table table-bordered table-hover" id="table">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    <h6>PARADAS REGISTRADAS</h6>
                                </th>
                            </tr>
                            <tr class="active">
                                <th>paro</th>
                                <th>subparo</th>
                                <th>razón</th>
                                <th>tiempo</th>
                                <th>descripción</th>
                                <th>created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($paros as $value): ?>
                                <tr>
                                    <td><?php echo $value->paro ?></td>
                                    <td><?php echo $value->subparo ?></td>
                                    <td><?php echo $value->razon ?></td>
                                    <td><?php echo $value->tiempo ?></td>
                                    <td><?php echo $value->descripcion ?></td>
                                    <td><?php echo $value->created ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <table class="table table-bordered table-hover" id="table">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    <h6>PARADAS REGISTRADAS</h6>
                                </th>
                            </tr>
                            <tr class="active">
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>paro</th>
                                <th>subparo</th>
                                <th>razón</th>
                                <th>Duración</th>
                                <th>descripción</th>
                                <th>created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($paros as $value):
                                $partes = explode('-', $value->paro);
                                // print_r($partes);
                                $value->paro = $partes[1]; // "Mantenimiento Programado"
                                $value->subparo = $partes[2]; // "Mantenimiento Programado"
                                $value->razon = $partes[3]; // "ee43"
                            ?>
                                <tr>
                                    <td><?php echo $value->inicio ?></td>
                                    <td><?php echo $value->fin ?></td>
                                    <td><?php echo $value->paro ?></td>
                                    <td><?php echo $value->subparo ?></td>
                                    <td><?php echo $value->razon ?></td>
                                    <td><?php echo $value->tiempo ?></td>
                                    <td><?php echo $value->descripcion ?></td>
                                    <td><?php echo $value->created ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>


                <?php endif; ?>
            </div>
        </div>
    </div>
</div>