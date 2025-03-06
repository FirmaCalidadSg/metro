<div class="container">
    <div id="dashboard" class="row" style="padding: 1%;">
        <div class="col-sm-6" style="padding:10px;">
            <div class="card" id="produccion-turno" style="width: 100%; height: 400px; padding:10px    "></div>

        </div>
        <div class="col-sm-6" style="padding:10px;">
            <div class="card" id="desperdicio-linea" style="width: 100%; height: 400px; padding:10px    "></div>

        </div>
        <div class="col-sm-6" style="padding:10px;">
            <div class="card" id="eficiencia-turno" style="width: 100%; height: 400px; padding:10px    "></div>

        </div>
        <div class="col-sm-6" style="padding:10px;">
            <div class="card" id="paros-linea" style="width: 100%; height: 400px; padding:10px "></div>

        </div>
        <div class="col-sm-6" style="padding:10px;">
            <div class="card" id="productos-por-linea" style="width: 100%; height: 400px; padding:10px "></div>

        </div>

        <div class="col-sm-6" style="padding:10px;">
            <div class="card" id="capacidad-planta" style="width: 100%; height: 400px; padding:10px    "></div>

        </div>
        <div class="col-sm-6" style="padding:10px;">
            <div class="card" id="produccion-capacidad" style="width: 100%; height: 400px; padding:10px    "></div>

        </div>
    </div>
</div>

<?php 
// session_start();
print_r($_SESSION['userData']);
?>
<script>
    // Inicializa ECharts
    const charts = {
        produccionTurno: echarts.init(document.getElementById('produccion-turno')),
        parosLinea: echarts.init(document.getElementById('paros-linea')),
        productosPorLinea: echarts.init(document.getElementById('productos-por-linea')),
        capacidadPlanta: echarts.init(document.getElementById('capacidad-planta')),
        produccionCapacidad: echarts.init(document.getElementById('produccion-capacidad')),
        desperdicioLinea: echarts.init(document.getElementById('desperdicio-linea')),
        eficienciaTurno: echarts.init(document.getElementById('eficiencia-turno')),
    };

    // Gráfica 1: Producción por Turno (Barras Redondeadas)
    charts.produccionTurno.setOption({
        title: { text: 'Producción por Turno', left: 'center' },
        tooltip: { trigger: 'axis' },
        xAxis: { type: 'category', data: ['Turno 1', 'Turno 2', 'Turno 3'] },
        yAxis: { type: 'value', name: 'Cantidad Producida' },
        series: [{
            type: 'bar',
            data: [120, 150, 110],
            itemStyle: {
                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                    { offset: 0, color: '#4CAF50' },
                    { offset: 1, color: '#388E3C' }
                ]),
                borderRadius: [10, 10, 0, 0] // Bordes redondeados arriba
            },
            barWidth: '50%',
        }],
    });

    // Gráfica 2: Tasa de Paros por Línea (Pareto Mejorado)
    var data = [
        { name: 'Línea 1', value: 30 },
        { name: 'Línea 2', value: 20 },
        { name: 'Línea 3', value: 25 },
        { name: 'Línea 4', value: 25 }
    ];

    // Ordenar y calcular porcentaje acumulado
    data.sort((a, b) => b.value - a.value);
    var total = data.reduce((sum, item) => sum + item.value, 0);
    var cumulativeSum = 0;
    var cumulativeData = data.map(item => {
        cumulativeSum += item.value;
        return (cumulativeSum / total) * 100;
    });

    charts.parosLinea.setOption({
        title: { text: 'Tasa de Paros por Línea (Pareto)', left: 'center' },
        tooltip: { trigger: 'axis', axisPointer: { type: 'cross' } },
        xAxis: { type: 'category', data: data.map(item => item.name), axisLabel: { rotate: 30 } },
        yAxis: [
            { type: 'value', name: 'Frecuencia', position: 'left' },
            { type: 'value', name: 'Porcentaje Acumulado', position: 'right', min: 0, max: 100, axisLabel: { formatter: '{value}%' } }
        ],
        series: [
            {
                name: 'Frecuencia',
                type: 'bar',
                data: data.map(item => item.value),
                itemStyle: {
                    color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                        { offset: 0, color: '#FF5722' },
                        { offset: 1, color: '#E64A19' }
                    ]),
                    borderRadius: [10, 10, 0, 0]
                },
                barWidth: '50%',
            },
            {
                name: 'Porcentaje Acumulado',
                type: 'line',
                yAxisIndex: 1,
                data: cumulativeData,
                itemStyle: { color: '#3F51B5' },
                smooth: true,
                symbol: 'circle',
                symbolSize: 8,
                lineStyle: { width: 2 },
            }
        ]
    });

    // Gráfica 3: Productos por Línea (Barras Coloridas y Redondeadas)
    charts.productosPorLinea.setOption({
        title: { text: 'Productos por Línea', left: 'center', textStyle: { fontSize: 16 } },
        tooltip: { trigger: 'axis', formatter: '{b}: {c}' },
        xAxis: { type: 'category', data: ['Línea 1', 'Línea 2', 'Línea 3', 'Línea 4'], axisLabel: { rotate: 45 } },
        yAxis: { type: 'value', name: 'Número de Productos' },
        series: [{
            type: 'bar',
            data: [12, 8, 15, 10],
            itemStyle: {
                color: function (params) {
                    let colors = ['#3F51B5', '#4CAF50', '#FFC107', '#FF5722'];
                    return colors[params.dataIndex];
                },
                borderRadius: [10, 10, 0, 0]
            },
            barWidth: '50%',
            label: { show: true, position: 'top', formatter: '{c}' },
        }],
    });

    // Gráfica 4: Capacidad Utilizada por Planta (Línea con Sombra y Puntos Suaves)
    charts.capacidadPlanta.setOption({
        title: { text: 'Capacidad Utilizada por Planta', left: 'center' },
        tooltip: { trigger: 'axis' },
        xAxis: { type: 'category', data: ['Planta 1', 'Planta 2', 'Planta 3'] },
        yAxis: { type: 'value', name: 'Porcentaje (%)', max: 100 },
        series: [{
            type: 'line',
            data: [75, 85, 65],
            itemStyle: { color: '#673AB7' },
            smooth: true,
            symbol: 'circle',
            symbolSize: 10,
            areaStyle: {
                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [
                    { offset: 0, color: 'rgba(103, 58, 183, 0.5)' },
                    { offset: 1, color: 'rgba(103, 58, 183, 0)' }
                ])
            },
            lineStyle: { width: 3 },
        }],
    });



    // 📊 1️⃣ Producción vs. Capacidad de la Planta
    charts.produccionCapacidad.setOption({
        title: { text: 'Producción vs. Capacidad de la Planta', left: 'center' },
        tooltip: { trigger: 'axis' },
        xAxis: { type: 'category', data: ['Planta 1', 'Planta 2', 'Planta 3'] },
        yAxis: { type: 'value', name: 'Toneladas' },
        series: [
            {
                name: 'Producción Real',
                type: 'bar',
                data: [900, 750, 850],
                itemStyle: { color: '#4CAF50', borderRadius: [10, 10, 0, 0] },
                barWidth: '50%',
            },
            {
                name: 'Capacidad Máxima',
                type: 'bar',
                data: [1000, 1000, 1000],
                itemStyle: { color: '#FF9800', borderRadius: [10, 10, 0, 0] },
                barWidth: '50%',
            }
        ]
    });

    // 🚨 2️⃣ Desperdicio por Línea de Producción
    charts.desperdicioLinea.setOption({
        title: { text: 'Desperdicio por Línea de Producción', left: 'center' },
        tooltip: { trigger: 'axis' },
        xAxis: { type: 'category', data: ['Línea 1', 'Línea 2', 'Línea 3', 'Línea 4'] },
        yAxis: { type: 'value', name: 'Kg de desperdicio' },
        series: [{
            type: 'bar',
            data: [50, 30, 70, 40],
            itemStyle: { color: '#E53935', borderRadius: [10, 10, 0, 0] },
            label: { show: true, position: 'top', formatter: '{c} Kg' },
            barWidth: '50%',
        }]
    });

    // ⚙️ 3️⃣ Eficiencia Operativa por Turno
    charts.eficienciaTurno.setOption({
        title: { text: 'Eficiencia Operativa por Turno (%)', left: 'center' },
        tooltip: { trigger: 'axis' },
        xAxis: { type: 'category', data: ['Turno 1', 'Turno 2', 'Turno 3'] },
        yAxis: { type: 'value', name: 'Eficiencia (%)', max: 100 },
        series: [{
            type: 'line',
            data: [85, 78, 92],
            smooth: true,
            symbol: 'circle',
            symbolSize: 8,
            itemStyle: { color: '#3F51B5' },
            lineStyle: { width: 3 },
            areaStyle: { color: 'rgba(63, 81, 181, 0.2)' },
        }]
    });





</script>