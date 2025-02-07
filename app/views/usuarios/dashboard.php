<div class="row">
    <div class="col-5" id="main" style="width: 600px;height:400px;"></div>
    <div class="col-6" id="main2" style="width: 600px;height:400px;"></div>
    <div class="col-5" id="main3" style="width: 600px;height:400px;"></div>
    <div class="col-6" id="main4" style="width: 600px;height:400px;"></div>
</div>

<script type="text/javascript">
    // Initialize the echarts instance based on the prepared dom
    var myChart = echarts.init(document.getElementById('main'));
    // Specify the configuration items and data for the chart
    var option = {
        title: {
            text: 'ECharts Getting Started Example'
        },
        tooltip: {},
        legend: {
            data: ['sales']
        },
        xAxis: {
            data: ['Shirts', 'Cardigans', 'Chiffons', 'Pants', 'Heels', 'Socks']
        },
        yAxis: {},
        series: [{
            name: 'sales',
            type: 'bar',
            data: [5, 20, 36, 10, 10, 20]
        }]
    };

    // Display the chart using the configuration items and data just specified.
    myChart.setOption(option);
    /**----------------- */
    // Initialize the echarts instance based on the prepared dom
    var myChart2 = echarts.init(document.getElementById('main2'));
    // Specify the configuration items and data for the chart
    var option = {
        tooltip: {
            trigger: 'item'
        },
        legend: {
            top: '5%',
            left: 'center'
        },
        series: [{
            name: 'Access From',
            type: 'pie',
            radius: ['40%', '70%'],
            avoidLabelOverlap: false,
            itemStyle: {
                borderRadius: 10,
                borderColor: '#fff',
                borderWidth: 2
            },
            label: {
                show: false,
                position: 'center'
            },
            emphasis: {
                label: {
                    show: true,
                    fontSize: 40,
                    fontWeight: 'bold'
                }
            },
            labelLine: {
                show: false
            },
            data: [{
                    value: 1048,
                    name: 'Search Engine'
                },
                {
                    value: 735,
                    name: 'Direct'
                },
                {
                    value: 580,
                    name: 'Email'
                },
                {
                    value: 484,
                    name: 'Union Ads'
                },
                {
                    value: 300,
                    name: 'Video Ads'
                }
            ]
        }]
    }

    // Display the chart using the configuration items and data just specified.
    myChart2.setOption(option);
    /**----------------- */
    // Initialize the echarts instance based on the prepared dom
    var myChart3 = echarts.init(document.getElementById('main3'));
    // Specify the configuration items and data for the chart
    option = {
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b}: {c} ({d}%)'
        },
        legend: {
            data: [
                'Direct',
                'Marketing',
                'Search Engine',
                'Email',
                'Union Ads',
                'Video Ads',
                'Baidu',
                'Google',
                'Bing',
                'Others'
            ]
        },
        series: [{
                name: 'Access From',
                type: 'pie',
                selectedMode: 'single',
                radius: [0, '30%'],
                label: {
                    position: 'inner',
                    fontSize: 14
                },
                labelLine: {
                    show: false
                },
                data: [{
                        value: 1548,
                        name: 'Search Engine'
                    },
                    {
                        value: 775,
                        name: 'Direct'
                    },
                    {
                        value: 679,
                        name: 'Marketing',
                        selected: true
                    }
                ]
            },
            {
                name: 'Access From',
                type: 'pie',
                radius: ['45%', '60%'],
                labelLine: {
                    length: 30
                },
                label: {
                    formatter: '{a|{a}}{abg|}\n{hr|}\n  {b|{b}：}{c}  {per|{d}%}  ',
                    backgroundColor: '#F6F8FC',
                    borderColor: '#8C8D8E',
                    borderWidth: 1,
                    borderRadius: 4,
                    rich: {
                        a: {
                            color: '#6E7079',
                            lineHeight: 22,
                            align: 'center'
                        },
                        hr: {
                            borderColor: '#8C8D8E',
                            width: '100%',
                            borderWidth: 1,
                            height: 0
                        },
                        b: {
                            color: '#4C5058',
                            fontSize: 14,
                            fontWeight: 'bold',
                            lineHeight: 33
                        },
                        per: {
                            color: '#fff',
                            backgroundColor: '#4C5058',
                            padding: [3, 4],
                            borderRadius: 4
                        }
                    }
                },
                data: [{
                        value: 1048,
                        name: 'Baidu'
                    },
                    {
                        value: 335,
                        name: 'Direct'
                    },
                    {
                        value: 310,
                        name: 'Email'
                    },
                    {
                        value: 251,
                        name: 'Google'
                    },
                    {
                        value: 234,
                        name: 'Union Ads'
                    },
                    {
                        value: 147,
                        name: 'Bing'
                    },
                    {
                        value: 135,
                        name: 'Video Ads'
                    },
                    {
                        value: 102,
                        name: 'Others'
                    }
                ]
            }
        ]
    };

    // Display the chart using the configuration items and data just specified.
    myChart3.setOption(option);
    /**----------------- */
    // Initialize the echarts instance based on the prepared dom
    var myChart4 = echarts.init(document.getElementById('main4'));
    // Specify the configuration items and data for the chart
    const data = [];
    for (let i = 0; i < 5; ++i) {
        data.push(Math.round(Math.random() * 200));
    }
    option4 = {
        xAxis: {
            max: 'dataMax'
        },
        yAxis: {
            type: 'category',
            data: ['A', 'B', 'C', 'D', 'E'],
            inverse: true,
            animationDuration: 300,
            animationDurationUpdate: 300,
            max: 2 // only the largest 3 bars will be displayed
        },
        series: [{
            realtimeSort: true,
            name: 'X',
            type: 'bar',
            data: data,
            label: {
                show: true,
                position: 'right',
                valueAnimation: true
            }
        }],
        legend: {
            show: true
        },
        animationDuration: 0,
        animationDurationUpdate: 3000,
        animationEasing: 'linear',
        animationEasingUpdate: 'linear'
    };

    function run() {
        for (var i = 0; i < data.length; ++i) {
            if (Math.random() > 0.9) {
                data[i] += Math.round(Math.random() * 2000);
            } else {
                data[i] += Math.round(Math.random() * 200);
            }
        }
        myChart.setOption({
            series: [{
                type: 'bar',
                data
            }]
        });
    }
    setTimeout(function() {
        run();
    }, 0);
    setInterval(function() {
        run();
    }, 3000);
    

    // Display the chart using the configuration items and data just specified.
    myChart4.setOption(option4);
</script>