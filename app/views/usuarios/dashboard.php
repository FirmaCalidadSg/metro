<div style="width:87%;">
<div id="dashboard" class="row" style="padding: 1%;" >
    <div class="col-sm-6" style="padding:10px;">
    <div   class="card" id="produccion-turno" style="width: 100%; height: 400px; padding:10px    "></div>

    </div>
    <div class="col-sm-6" style="padding:10px;">
    <div  class="card"  id="paros-linea" style="width: 100%; height: 400px; padding:10px "></div>

    </div>    
    <div class="col-sm-6" style="padding:10px;">
    <div  class="card"  id="productos-por-linea" style="width: 100%; height: 400px; padding:10px "></div>

    </div>    
    <div class="col-sm-6" style="padding:10px;">
    <div   class="card" id="capacidad-planta" style="width: 100%; height: 400px; padding:10px    "></div>

    </div>    
   

</div>
</div>

<script>
    // Inicializa ECharts
    const charts = {
        produccionTurno: echarts.init(document.getElementById('produccion-turno')),
        parosLinea: echarts.init(document.getElementById('paros-linea')),
        productosPorLinea: echarts.init(document.getElementById('productos-por-linea')),
        capacidadPlanta: echarts.init(document.getElementById('capacidad-planta')),
    };

    // Gráfica 1: Producción por Turno
    charts.produccionTurno.setOption({
        title: {
            text: 'Producción por Turno',
            left: 'center'
        },
        tooltip: {
            trigger: 'axis'
        },
        xAxis: {
            type: 'category',
            data: ['Turno 1', 'Turno 2', 'Turno 3']
        },
        yAxis: {
            type: 'value',
            name: 'Cantidad Producida'
        },
        series: [{
            type: 'bar',
            data: [120, 150, 110], // Ejemplo de datos
            color: '#4CAF50',
        }, ],
    });

    // Gráfica 2: Tasa de Paros por Línea
    charts.parosLinea.setOption({
        title: {
            text: 'Tasa de Paros por Línea',
            left: 'center',
            textStyle: {
                fontSize: 16
            }
        },
        tooltip: {
            trigger: 'item',
            formatter: '{b}: {c} ({d}%)' // Muestra nombre, valor y porcentaje
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: ['Línea 1', 'Línea 2', 'Línea 3', 'Línea 4'], // Ejemplo de nombres de líneas
        },
        series: [{
            name: 'Tasa de Paros',
            type: 'pie',
            radius: '55%',
            center: ['50%', '50%'],
            data: [{
                    value: 30,
                    name: 'Línea 1'
                },
                {
                    value: 20,
                    name: 'Línea 2'
                },
                {
                    value: 25,
                    name: 'Línea 3'
                },
                {
                    value: 25,
                    name: 'Línea 4'
                },
            ], // Datos de ejemplo
            emphasis: {
                itemStyle: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)',
                },
            },
            label: {
                formatter: '{b}: {c} ({d}%)', // Etiquetas claras con valores y porcentajes
            },
            color: ['#FF5722', '#FFC107', '#4CAF50', '#3F51B5'], // Colores distintivos
        }, ],
    });

    // Gráfica 3: Estados de Documentos
    charts.productosPorLinea.setOption({
        title: {
            text: 'Productos por Línea',
            left: 'center',
            textStyle: {
                fontSize: 16
            }
        },
        tooltip: {
            trigger: 'axis',
            formatter: '{b}: {c}'
        },
        xAxis: {
            type: 'category',
            data: ['Línea 1', 'Línea 2', 'Línea 3', 'Línea 4'], // Nombres de líneas de ejemplo
            axisLabel: {
                rotate: 45 // Rotar etiquetas si son largas
            },
        },
        yAxis: {
            type: 'value',
            name: 'Número de Productos',
        },
        series: [{
            type: 'bar',
            data: [12, 8, 15, 10], // Datos de ejemplo (número de productos por línea)
            color: ['#3F51B5', '#4CAF50', '#FFC107', '#FF5722'],
            barWidth: '50%', // Ancho de las barras
            label: {
                show: true,
                position: 'top',
                formatter: '{c}', // Mostrar el número encima de cada barra
            },
        }],
    });
    // Gráfica 4: Capacidad Utilizada por Planta
    charts.capacidadPlanta.setOption({
        title: {
            text: 'Capacidad Utilizada por Planta',
            left: 'center'
        },
        tooltip: {
            trigger: 'axis'
        },
        xAxis: {
            type: 'category',
            data: ['Planta 1', 'Planta 2', 'Planta 3']
        },
        yAxis: {
            type: 'value',
            name: 'Porcentaje (%)',
            max: 100
        },
        series: [{
            type: 'line',
            data: [75, 85, 65], // Ejemplo de datos
            color: '#673AB7',
        }, ],
    });
</script>