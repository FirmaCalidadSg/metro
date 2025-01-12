<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../app/Assets/css/globals.css" />
    <link rel="stylesheet" href="../app/Assets/css/styleguide.css" />
    <link rel="stylesheet" href="../app/Assets/css/style.css" />
</head>

<body>
    <div class="resultados-informes">
        <button class="btn-back"> 
            <div class="text-wrapper"> < Volver</div>
        </button>
        <div class="actividad-de">
            <header class="header">
                <div class="text">
                    <div class="div">Eficiencias</div>
                    <div class="frame-2">
                        <div class="frame-3">
                            <div class="frame-4">
                                <div class="div-wrapper">
                                    <div class="text-wrapper-2">01/10/2024</div>
                                </div>
                            </div>
                            <div class="frame-4">
                                <div class="div-wrapper">
                                    <div class="text-wrapper-2">-</div>
                                </div>
                            </div>
                            <div class="frame-4">
                                <div class="div-wrapper">
                                    <div class="text-wrapper-2">16/10/2024</div>
                                </div>
                            </div>
                        </div>
                        <div class="frame-4">
                            <div class="div-wrapper">
                                <div class="text-wrapper-3">Planta:</div>
                            </div>
                            <div class="div-wrapper">
                                <div class="text-wrapper-2">Buga</div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="primary-buttom"> <img class="img" src="../../app/Assets/css/images/folder-down.svg" />
                    <div class="guardar">Descargar</div>
                </button>
        
            <div class="space-input">
                <select class="selector-table" id="valor-selector">
                    <option value="" disabled selected>Filtrar por definicion</option>
                        <?php foreach ($definicion as $value): ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../../app/Assets/css/images/underline.svg">
                </div>
                <div class="space-input">
                    <select class="selector-table" id="departamento-selector">
                        <option value="" disabled selected>Filtrar por valor</option>
                        <?php foreach ($definicion as $value): ?>
                            <option value="<?php echo $value->valor; ?>"><?php echo $value->valor; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../../app/Assets/css/images/underline.svg">
                </div>
            </header>
            <div class="div-2">
                <table class="table_container">
                    <thead>
                        <tr>
                            <th>Proceso</th>
                            <th>Linea</th>
                            <th>Disponibilidad</th>
                            <th>D Proceso</th>
                            <th>Disponibilidad MM</th>
                            <th>Rendimiento</th>
                            <th>Calidad</th>
                            <th>Eficiencia</th>
                            <th>TFFP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Liquidos Buga</td>
                            <td>Linea 1</td>
                            <td>80%</td>
                            <td>50%</td>
                            <td>60%</td>
                            <td>70%</td>
                            <td>80%</td>
                            <td>90%</td>
                            <td>90%</td>
                        </tr>
                        <tr>
                            <td>Liquidos Buga</td>
                            <td>Linea 2</td>
                            <td>80%</td>
                            <td>50%</td>
                            <td>60%</td>
                            <td>70%</td>
                            <td>80%</td>
                            <td>90%</td>
                            <td>90%</td>
                        </tr>
                        <tr>
                            <td>Liquidos Buga</td>
                            <td>Linea 3</td>
                            <td>80%</td>
                            <td>50%</td>
                            <td>60%</td>
                            <td>70%</td>
                            <td>80%</td>
                            <td>90%</td>
                            <td>90%</td>
                        </tr>
                        <tr>
                            <td>Proteicos Buga</td>
                            <td>Linea 1</td>
                            <td>80%</td>
                            <td>50%</td>
                            <td>60%</td>
                            <td>70%</td>
                            <td>80%</td>
                            <td>90%</td>
                            <td>90%</td>
                        </tr>
                        <tr>
                            <td>Harinas Buga</td>
                            <td>Linea 1</td>
                            <td>80%</td>
                            <td>50%</td>
                            <td>60%</td>
                            <td>70%</td>
                            <td>80%</td>
                            <td>90%</td>
                            <td>90%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>